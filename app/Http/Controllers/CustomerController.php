<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Repositories\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        return $this->customerRepository = $customerRepository;
    }

    public function index()
    {
        $customers = $this->customerRepository->all();

        return $customers;
    }

    public function show($customerId)
    {
        $customer = $this->customerRepository->findById($customerId);

        return $customer;
    }

    public function update($customerId)
    {
        $this->customerRepository->update($customerId);

        return redirect('/customers/' . $customerId);
    }

    public function destroy($customerId)
    {
        $this->customerRepository->delete($customerId);

        return redirect('/');
    }

}
