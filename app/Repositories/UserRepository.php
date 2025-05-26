<?php

namespace App\Repositories;
use App\Models\User;

class UserRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getStudents()
    {
        $students = User::where('role', '=', 'student')->get();
        return $students;
    }

    public function getUserId($name)
    {
        $user = User::where('name', $name)->first();
        return $user?->id;
    }

    public function createUser($data)
    {
        $user = User::create($data);
        return $user;
    }

    public function existUser($email)
    {
        return User::where('email', $email)->exists();
    }

    public function getTeachers()
    {
        $teachers = User::where('role', '=', 'teacher')->get();
        return $teachers;
    }

    public function createStudent($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'image' => $data['image']
        ]);
    }

    public function destroy($id)
    {
        return User::where('id', $id)->delete();
    }

    public function update($id, $data)
    {
        return User::where('id', $id)->update($data);
    }

    public function getUserIdByEmail($email)
    {
        $user = user::where('email', $email)->first();
        return $user?->id;
    }
}