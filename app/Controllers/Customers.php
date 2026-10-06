<?php

namespace App\Controllers;

use App\Models\CustomerAccountModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Customers extends BaseController
{
    private CustomerAccountModel $customers;

    public function __construct()
    {
        $this->customers = new CustomerAccountModel();
    }

    public function index()
    {
        $search = trim((string) $this->request->getGet('search'));
        $status = (string) $this->request->getGet('status');
        $type = (string) $this->request->getGet('type');

        if ($search !== '') {
            $this->customers->groupStart()
                ->like('account_number', $search)
                ->orLike('customer_name', $search)
                ->orLike('email', $search)
                ->orLike('meter_number', $search)
                ->groupEnd();
        }

        if (in_array($status, ['active', 'inactive', 'suspended'], true)) {
            $this->customers->where('status', $status);
        }

        if (in_array($type, ['residential', 'commercial', 'industrial'], true)) {
            $this->customers->where('connection_type', $type);
        }

        return view('customers/index', [
            'title'             => 'Customer Dashboard',
            'accounts'          => $this->customers->orderBy('id', 'DESC')->paginate(10, 'customers'),
            'pager'             => $this->customers->pager,
            'search'            => $search,
            'selectedStatus'    => $status,
            'selectedType'      => $type,
            'totalAccounts'     => (new CustomerAccountModel())->countAll(),
            'activeAccounts'    => (new CustomerAccountModel())->where('status', 'active')->countAllResults(),
            'inactiveAccounts'  => (new CustomerAccountModel())->where('status', 'inactive')->countAllResults(),
            'suspendedAccounts' => (new CustomerAccountModel())->where('status', 'suspended')->countAllResults(),
        ]);
    }

    public function show(int $id)
    {
        return view('customers/show', [
            'title'   => 'Customer Details',
            'account' => $this->findAccount($id),
        ]);
    }

    public function new()
    {
        return view('customers/form', [
            'title'   => 'Add Customer',
            'account' => [],
            'isEdit'  => false,
        ]);
    }

    public function create()
    {
        if (! $this->validate($this->rules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->formData();
        if ($this->accountNumberExists($data['account_number'])) {
            return redirect()->back()->withInput()->with('error', 'The account number is already in use.');
        }

        $this->customers->insert($data);

        return redirect()->to(site_url('customers'))->with('success', 'Customer account created successfully.');
    }

    public function edit(int $id)
    {
        return view('customers/form', [
            'title'   => 'Edit Customer',
            'account' => $this->findAccount($id),
            'isEdit'  => true,
        ]);
    }

    public function update(int $id)
    {
        $this->findAccount($id);

        if (! $this->validate($this->rules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->formData();
        if ($this->accountNumberExists($data['account_number'], $id)) {
            return redirect()->back()->withInput()->with('error', 'The account number is already in use.');
        }

        $this->customers->update($id, $data);

        return redirect()->to(site_url('customers/' . $id))->with('success', 'Customer account updated successfully.');
    }

    public function delete(int $id)
    {
        $account = $this->findAccount($id);
        $this->customers->delete($id);

        return redirect()->to(site_url('customers'))
            ->with('success', $account['customer_name'] . ' was deleted successfully.');
    }

    private function rules(): array
    {
        return [
            'account_number'  => 'required|max_length[50]',
            'customer_name'   => 'required|max_length[150]',
            'address'         => 'required|max_length[500]',
            'phone'           => 'permit_empty|max_length[20]',
            'email'           => 'permit_empty|valid_email|max_length[100]',
            'meter_number'    => 'required|max_length[50]',
            'connection_type' => 'required|in_list[residential,commercial,industrial]',
            'status'          => 'required|in_list[active,inactive,suspended]',
        ];
    }

    private function formData(): array
    {
        return [
            'account_number'  => trim((string) $this->request->getPost('account_number')),
            'customer_name'   => trim((string) $this->request->getPost('customer_name')),
            'address'         => trim((string) $this->request->getPost('address')),
            'phone'           => trim((string) $this->request->getPost('phone')),
            'email'           => trim((string) $this->request->getPost('email')),
            'meter_number'    => trim((string) $this->request->getPost('meter_number')),
            'connection_type' => (string) $this->request->getPost('connection_type'),
            'status'          => (string) $this->request->getPost('status'),
        ];
    }

    private function findAccount(int $id): array
    {
        $account = $this->customers->find($id);
        if ($account === null) {
            throw PageNotFoundException::forPageNotFound('Customer account not found.');
        }

        return $account;
    }

    private function accountNumberExists(string $accountNumber, ?int $ignoreId = null): bool
    {
        $query = (new CustomerAccountModel())->where('account_number', $accountNumber);
        if ($ignoreId !== null) {
            $query->where('id !=', $ignoreId);
        }

        return $query->first() !== null;
    }
}
