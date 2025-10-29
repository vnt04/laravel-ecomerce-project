<?php
namespace App\Services\Implementations;

use App\Services\ICustomerService;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ICustomerRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CustomerServiceImpl implements ICustomerService {
    protected ICustomerRepository $customerRepository;

    public function __construct(ICustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function register($newCustomerData){
        return $this->customerRepository->create($newCustomerData);
    }

    public function login(string $email, string $password){
        $customer = $this->customerRepository->findByEmail($email);

        if (!$customer || !Hash::check($password, $customer->password)) {
            return null;
        }
        $token = $this->customerRepository->createToken($customer,'customer_token');

        return [
            'customer_data'  => $customer,
            'token' => $token
        ];
    }

    public function updateProfile(int $customerId, array $data){ 
        $authCustomerId = auth('customer')->id();

        $customer = $this->customerRepository->findById($customerId);
        if (!$customer) {
            throw new NotFoundHttpException('Customer not found');
        }
        
        if ($customerId !== $authCustomerId) {
            throw new AuthorizationException('Cannot update other customer profile');
        }

        return $this->customerRepository->updateProfile($customerId,$data);
    }
}