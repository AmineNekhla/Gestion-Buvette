<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerUser()
    {
        $model = new UserModel();

        if (!$this->validate([
            'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ])) {
            return redirect()->to('/register')->withInput()->with('errors', $this->validator->getErrors());
        }

        $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $hashedPassword,
            'role' => 0, // Default role (e.g., regular user)
        ];
        $model->save($data);

        return redirect()->to('/login')->with('success', 'Inscription réussie. Veuillez vous connecter.');
    }

    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/products');
        }

        return view('auth/login');
    }

    public function loginUser()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
                'isLoggedIn' => true,
            ]);

            return redirect()->to('/products');
        }

        return redirect()->back()->with('error', 'Identifiants invalides.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Déconnexion réussie.');
    }
}
