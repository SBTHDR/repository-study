<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    public function all()
    {
        return Customer::orderBy('name')
            ->where('active', 1)
            ->with('user')
            ->get()
            ->map->format();

            // return Customer::orderBy('name')
            // ->where('active', 1)
            // ->with('user')
            // ->get()
            // ->map(function($customer) {
            //     // return $this->format($customer);
            //     return $customer->format();
            // });
    }

    public function findById($customerId)
    {
        return Customer::where('id', $customerId)
            ->where('active', 1)
            ->with('user')
            ->firstOrFail()
            ->format();

        // $customer =  Customer::where('id', $customerId)
        //     ->where('active', 1)
        //     ->with('user')
        //     ->firstOrFail();

        // return $this->format($customer);
    }

    // protected function format($customer)
    // {
    //     return [
    //         'customer_id' => $customer->id,
    //         'customer_name' => $customer->name,
    //         'customer_created_by' => $customer->user->email,
    //         'customer_last_updated' => $customer->updated_at->diffForHumans(),
    //     ];
    // }
    
    public function update($customerId)
    {
        $customer = Customer::where('id', $customerId)->firstOrFail();

        $customer->update(request()->only('name'));
    }

    public function delete($customerId)
    {
        $customer = Customer::where('id', $customerId)->delete();
    }
}