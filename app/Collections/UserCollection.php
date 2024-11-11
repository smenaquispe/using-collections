<?php

namespace App\Collections;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserCollection extends Collection
{
    public function afterById(string $id)
    {
        $user = $this->firstWhere('id', $id);
        return $this->after($user);
    }

    public function beforeById(string $id)
    {
        $user = $this->firstWhere('id', $id);
        return $this->before($user);
    }

    public function chunkWhileUserAgeIsLessThan(int $age)
    {
        return $this->chunkWhile(fn ($user) => $user->age < $age);
    }

    public function averageAge()
    {
        return $this->avg('age');
    }

    public function containsEmail(string $email) : bool
    {
        return $this->contains(fn (User $user) => $user->email === $email);
    }

    public function countByRole()
    {
        return $this->countBy('role');
    }

    public function crossJoinWithPosts(PostCollection $posts)
    {
        return $this->crossJoin($posts);
    }

    public function diffWithAdmins() : UserCollection
    {
        return $this->diff(User::where('role', 'admin')->get());
    }

    public function diffAssocWithAdmins(): UserCollection
    {
        return $this->diffAssoc(User::where('role', 'admin')->get());
    }

    public function diffKeysWithAdmins() : UserCollection
    {
        return $this->diffKeys(User::where('role', 'admin')->get());
    }

    public function doesntContainEmail(string $email) : bool
    {
        return $this->doesntContain(fn (User $user) => $user->email === $email);
    }

    public function eachEmail()
    {
        $emails = [];
        $this->each(function ($user) use (&$emails) {
            $emails[] = $user->email;
        });
        return $emails;
    }

    public function duplicatesByLastName()
    {
        return $this->toBase()->duplicates('last_name');
    }

    public function duplicatesStrictByLastName()
    {
        return $this->toBase()->duplicatesStrict('last_name');
    }

    public function everyIsAdult()
    {
        return $this->every(fn ($user) => $user->age >= 18);
    }

    public function appendAttribute(string $attribute) : UserCollection
    {
        return $this->append($attribute);
    }

    public function intersectUserAndAdmins() : UserCollection
    {
        return $this->intersect(User::where('role', 'admin')->get());
    }



    public function expectId(int $id) : UserCollection
    {
        return $this->except($id);
    }

    public function findById(int $id) : UserCollection | User
    {
        return $this->find($id);
    }

    public function findOrFailById(int $id) : UserCollection | User
    {
        return $this->findOrFail($id);
    }

    public function intersectWithAdmins() : UserCollection
    {
        return $this->intersect(User::where('role', 'admin')->get());
    }

    public function loadPosts() : UserCollection
    {
        return $this->load('posts');
    }

    public function loadMissingPosts() : UserCollection
    {
        return $this->loadMissing('posts');
    }

    public function getModelKeys() : array
    {
        return $this->modelKeys();
    }

    public function makeVisibleEmail() : UserCollection
    {
        return $this->makeVisible('email');
    }

    public function makeHiddenEmail() : UserCollection
    {
        return $this->makeHidden('email');
    }

    public function onlyIds() : UserCollection
    {
        return $this->only('id');
    }

    public function setVisibleAttributes(array $attributes) : UserCollection
    {
        return $this->setVisible($attributes);
    }

    public function setHiddenAttributes(array $attributes) : UserCollection
    {
        return $this->setHidden($attributes);
    }

    public function toQueryActiveUsers() : UserCollection
    {
        return $this->toQuery()->where('active', true)->get();
    }

    public function uniqueEmails() : UserCollection
    {
        return $this->unique('email');
    }

}
