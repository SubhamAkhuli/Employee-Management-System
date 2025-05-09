<?php

namespace App\Controllers;

use App\Models\EmpModel;

class EmployeeController extends BaseController
{
    protected $empModel;

    public function __construct()
    {
        helper(['form']);
        $this->empModel = new EmpModel();
    }

    private function checkAuth()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
    }

    public function index()
    {
        if ($response = $this->checkAuth()) {
            return $response;
        }

        $data['employees'] = $this->empModel->findAll();
        return view('employees/index', $data);
    }

    public function create()
    {
        if ($response = $this->checkAuth()) {
            return $response;
        }

        return view('employees/create');
    }

    public function store()
    {
        if ($response = $this->checkAuth()) {
            return $response;
        }

        $file = $this->request->getFile('picture');
        $pictureName = null;
        if ($file && $file->isValid()) {
            $pictureName = $file->getRandomName();
            // save to public/uploads so images are publicly accessible
            $file->move(FCPATH . 'uploads', $pictureName);
        }

        $this->empModel->save([
            'name'        => $this->request->getPost('name'),
            'address'     => $this->request->getPost('address'),
            'designation' => $this->request->getPost('designation'),
            'salary'      => $this->request->getPost('salary'),
            'picture'     => $pictureName
        ]);

        return redirect()->to('/employees');
    }

    public function edit($id)
    {
        if ($response = $this->checkAuth()) {
            return $response;
        }

        $data['employee'] = $this->empModel->find($id);
        return view('employees/edit', $data);
    }

    public function update($id)
    {
        if ($response = $this->checkAuth()) {
            return $response;
        }

        $emp = $this->empModel->find($id);
        $file = $this->request->getFile('picture');

        if ($file && $file->isValid()) {
            // delete old image from public/uploads
            if ($emp['picture'] && is_file(FCPATH . 'uploads/' . $emp['picture'])) {
                unlink(FCPATH . 'uploads/' . $emp['picture']);
            }
            $pictureName = $file->getRandomName();
            // save new image to public/uploads
            $file->move(FCPATH . 'uploads', $pictureName);
        } else {
            $pictureName = $emp['picture'];
        }

        $this->empModel->update($id, [
            'name'        => $this->request->getPost('name'),
            'address'     => $this->request->getPost('address'),
            'designation' => $this->request->getPost('designation'),
            'salary'      => $this->request->getPost('salary'),
            'picture'     => $pictureName
        ]);

        return redirect()->to('/employees');
    }

    public function delete($id)
    {
        if ($response = $this->checkAuth()) {
            return $response;
        }

        $emp = $this->empModel->find($id);
        // remove picture from public/uploads
        if ($emp['picture'] && is_file(FCPATH . 'uploads/' . $emp['picture'])) {
            unlink(FCPATH . 'uploads/' . $emp['picture']);
        }

        $this->empModel->delete($id);
        return redirect()->to('/employees');
    }
}