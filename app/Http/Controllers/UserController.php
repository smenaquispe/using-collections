<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Exceptions\NoUsersExceptions;
use Illuminate\Support\Collection;
use Barryvdh\Debugbar\Facades\Debugbar;

class UserController extends Controller
{
    public function index(Request $request)
    {
        Debugbar::info('This is some useful information.');
        Debugbar::startMeasure('render','Time for rendering');
        $users = User::all();
        if ($users->isEmpty()) {
            throw new NoUsersExceptions();
        }
        Debugbar::stopMeasure('render');
        Debugbar::info($users);
        //return view("index", ["users" => $users]);
        return response()->json($users, 200, [], JSON_PRETTY_PRINT);
    }

    public function insert(Request $request)
    {
        $user = new User();
        
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->age = $request->input('age');
        $user->status = $request->input('status');
        $user->save();

        return response()->json($user);
    }

    public function afterById(Request $request)
    {
        $id = $request->input('id');

        $users = User::all();
        $usersAfterId = $users->afterById($id);
        return response()->json($usersAfterId);
    }

    public function beforeById(Request $request)
    {
        $id = $request->input('id');

        $users = User::all();
        $usersBeforeId = $users->beforeById($id);
        return response()->json($usersBeforeId);
    }

    public function chunkUsers(Request $request)
    {
        $size = intval($request->input('size'));
        $users = User::all();
        $chunkedUsers = $users->chunk($size);
        return response()->json($chunkedUsers);
    }

    public function chunkWhileUserAgeIsLessThan(Request $request)
    {
        $age = intval($request->input('age'));

        $users = User::all();
        $chunkedUsers = $users->chunkWhileUserAgeIsLessThan($age);
        return response()->json($chunkedUsers);
    }

    public function averageAge()
    {
        $users = User::all();
        $averageAge = $users->averageAge();
        return response()->json(['average_age' => $averageAge]);
    }

    public function containsEmail(Request $request)
    {
        $email = $request->input('email');

        $users = User::all();
        $userContainsEmail = $users->containsEmail($email);
        return response()->json(['contains_email' => $userContainsEmail]);
    }

    public function containsOneItem(Request $request)
    {
        $users = User::all();
        $onlyOneItem = $users->containsOneItem();
        return response()->json(['only_one_item' => $onlyOneItem]);
    }

    public function countUsers()
    {
        $users = User::all();
        $usersCount = $users->count();
        return response()->json(['users_count' => $usersCount]);
    }

    public function countByRole(Request $request)
    {
        $users = User::all();
        $usersCountByRole = $users->countByRole();
        return response()->json(['users_count_by_role' => $usersCountByRole]);
    }

    public function crossJoinWithPosts()
    {
        $users = User::all();
        $posts = Post::all();
        $crossJoinedUsers = $users->crossJoinWithPosts($posts);
        return response()->json($crossJoinedUsers);
    }

    public function makeDD(Request $request)
    {
        $users = User::all();
        $users->dd();
    }

    public function diffWithAdmins()
    {
        $users = User::all();
        $diffWithAdmins = $users->diffWithAdmins();
        return response()->json($diffWithAdmins);
    }

    public function diffAssocWithAdmins()
    {
        $users = User::all();
        $diffAssocWithAdmins = $users->diffAssocWithAdmins();
        return response()->json($diffAssocWithAdmins);
    }

    public function diffKeysWithAdmins()
    {
        $users = User::all();
        $diffKeysWithAdmins = $users->diffKeysWithAdmins();
        return response()->json($diffKeysWithAdmins);
    }

    public function doesntContainEmail(Request $request)
    {
        $email = $request->input('email');
        $users = User::all();
        $doesntContainEmail = $users->doesntContainEmail($email);
        return response()->json(['doesnt_contain_email' => $doesntContainEmail]);
    }

    public function dot()
    {
        $users = User::all();
        $dot = $users->dot();
        return response()->json($dot);
    }


    public function dumpUsers()
    {
        $users = User::all();
        $users->dump();
        return response()->json($users);
    }

    public function duplicatesByLastName()
    {
        $users = User::all();
        $duplicates = $users->duplicatesByLastName();
        return response()->json($duplicates);
    }

    public function duplicatesStrictByLastName()
    {
        $users = User::all();
        $duplicatesStrict = $users->duplicatesStrictByLastName();
        return response()->json($duplicatesStrict);
    }

    public function eachEmail()
    {
        $users = User::all();
        $emails = $users->eachEmail();
        return response()->json($emails);
    }

    public function ensureExample()
    {
        $users = User::all();
        $users = $users->ensure(User::class);
        return response()->json($users);
    }

    public function everyExample()
    {
        $users = User::all();
        $result = $users->everyIsAdult();
        return response()->json(['all_adults' => $result]);
    }

    public function filterExample()
    {
        $users = User::all();
        $filtered = $users->filter(function ($user) {
            return $user->age > 20;
        });
        return response()->json($filtered->values());
    }

    public function firstExample()
    {
        $users = User::all();
        $firstUser = $users->first();
        return response()->json($firstUser);
    }

    public function firstOrFailExample()
    {
        $users = User::all();
        $firstUser = $users->firstOrFail();
        return response()->json($firstUser);
    }

    public function firstWhereLastName(Request $request)
    {
        $last_name = $request->input('last_name');
        $users = User::all();
        $user = $users->firstWhere('last_name', $last_name);
        return response()->json($user);
    }

    public function flatMapExample()
    {
        $users = User::all();
        $mapped = $users->flatMap(function ($user) {
            return [$user->id => $user->email];
        });
        return response()->json($mapped);
    }

    public function flattenExample()
    {
        $nestedArray = collect([
            ['name' => 'John'],
            [['name' => 'Jane']],
            [[['name' => 'Doe']]]
        ]);
        $flattened = $nestedArray->flatten();
        return response()->json($flattened);
    }

    public function flipExample()
    {
        Debugbar::startMeasure('render','Time for rendering');
        $users = User::pluck('email', 'id');
        $flipped = $users->flip();
        Debugbar::stopMeasure('render');
        //return view("index", ["users" => $flipped]);
        return response()->json($flipped);
    }

    public function forgetExample(Request $request)
    {
        $key = $request->input('key');
        $users = User::all();
        $users->forget(intval($key)); // removes the first user
        return response()->json($users);
    }

    public function forPageExample(Request $request)
    {
        $page = intval($request->input('page'));
        $size = intval($request->input('size'));
        $users = User::all();
        $paginated = $users->forPage($page, $size); // page 2 with 5 items per page
        return response()->json($paginated);
    }

    public function getExample(Request $request)
    {
        $key = $request->input('key');
        $users = User::all();
        $user = $users->get(intval($key)); // get user at index 1
        return response()->json($user);
    }

    public function groupByExample(Request $request)
    {
        $attribute = $request->input('attribute');
        $users = User::all();
        $grouped = $users->groupBy($attribute);
        return response()->json($grouped);
    }

    public function hasExample(Request $request)
    {
        $key = intval($request->input('key'));
        $users = User::all();
        $hasUser = $users->has($key);
        return response()->json(['has_user' => $hasUser]);
    }

    public function implodeExample(Request $request)
    {
        $attribute = $request->input('attribute');
        $users = User::all();
        $emails = $users->implode($attribute, ', ');
        return response()->json([$attribute => $emails]);
    }

    public function intersectExample(Request $request)
    {
        $ids = $request->input('ids');
        $array_ids = explode(',', $ids);
        $allUsers = User::pluck('id');
        $someUsers = collect($array_ids);
        $intersected = $allUsers->intersect($someUsers);
        return response()->json($intersected);
    }

    public function intersectAssocExample()
    {
        $users = User::all();
        $intersected = $users->intersectUserAndAdmins();
        return response()->json($intersected);
    }

    public function intersectByKeysExample()
    {
        $users1 = collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $users2 = collect(['a' => 1, 'b' => 3]);
        $intersectedKeys = $users1->intersectByKeys($users2);
        return response()->json($intersectedKeys);
    }

    public function isEmptyExample()
    {
        $users = User::all();
        return response()->json(['is_empty' => $users->isEmpty()]);
    }


    public function isNotEmpty()
    {
        $users = User::all();
        return response()->json(['isNotEmpty' => $users->isNotEmpty()]);
    }

    public function join(Request $request)
    {
        $users = User::pluck('first_name');
        $separator = $request->input('separator', ', ');
        return response()->json(['joinedNames' => $users->join($separator)]);
    }

    public function keyBy()
    {
        $users = User::all()->keyBy('email');
        return response()->json($users);
    }

    public function keys()
    {
        $users = User::all()->pluck('id');
        $keys = $users->keys();
        return response()->json($keys);
    }

    public function last(Request $request)
    {
        $users = User::all();
        $last = $users->last(function ($user) use ($request) {
            return $user->email === $request->input('email');
        });
        return response()->json($last);
    }

    public function lazy()
    {
        $users = User::lazy()->map(fn($user) => $user->first_name);
        return response()->json($users);
    }

    public function macro()
    {
        Collection::macro('getUserNames', function () {
            return $this->map(fn($user) => $user->first_name);
        });

        $users = User::all()->getUserNames();
        return response()->json($users);
    }

    public function make()
    {
        $users = collect(User::all());
        return response()->json($users);
    }

    public function map()
    {
        $users = User::all()->map(fn($user) => ['name' => strtoupper($user->first_name)]);
        return response()->json($users);
    }

    public function mapInto()
    {
        $collection = collect(["John", "Jane"]);
        $users = $collection->mapInto(User::class);
        return response()->json($users);
    }

    public function mapSpread()
    {
        // Obtener todos los usuarios
        $userNames = User::all()->map(function($user) {
            // Crear un array con los tres valores
            return [$user->first_name, $user->email, $user->age];
        })->mapSpread(function($name, $email, $age) {
            return compact('name', 'email', 'age');
        });
    
        return response()->json($userNames);
    }

    public function mapToGroups()
    {
        $users = User::all()->mapToGroups(fn($user) => [$user->role => $user->first_name]);
        return response()->json($users);
    }

    public function mapWithKeys()
    {
        $users = User::all()->mapWithKeys(fn($user) => [$user->id => $user->first_name]);
        return response()->json($users);
    }

    public function max()
    {
        $maxAge = User::all()->max('age');
        return response()->json(['maxAge' => $maxAge]);
    }

    public function median()
    {
        $medianAge = User::all()->median('age');
        return response()->json(['medianAge' => $medianAge]);
    }



    


    public function merge(Request $request)
    {
        $users = User::all();
        $additionalData = collect($request->input('additional_data', []));
        $merged = $users->merge($additionalData);
        return response()->json($merged);
    }

    public function mergeRecursive(Request $request)
    {
        $users = User::all()->keyBy('id');
        $additionalData = collect($request->input('additional_data', []));
        $mergedRecursive = $users->mergeRecursive($additionalData);
        return response()->json($mergedRecursive);
    }

    public function min()
    {
        $minId = User::all()->min('id');
        return response()->json(['minId' => $minId]);
    }

    public function mode()
    {
        $mode = User::all()->pluck('role')->mode();
        return response()->json(['mode' => $mode]);
    }

    public function multiply(Request $request)
    {
        $users = User::all();
        $multiplier = $request->input('multiplier', 1);
        $multiplied = $users->map(fn($user) => $user->id * $multiplier);
        return response()->json($multiplied);
    }

    public function nth(Request $request)
    {
        $users = User::all();
        $index = $request->input('index', 0);
        $nthUser = $users->nth($index);
        return response()->json($nthUser);
    }

    public function only(Request $request)
    {
        $users = User::all();
        $keys = $request->input('keys', []);
        $only = $users->only($keys);
        return response()->json($only);
    }

    public function pad(Request $request)
    {
        $users = User::all();
        $padSize = $request->input('size', 0);
        $padValue = $request->input('value', null);
        $padded = $users->pad($padSize, $padValue);
        return response()->json($padded);
    }

    public function partition(Request $request)
    {
        $users = User::all();
        $partitionBy = $request->input('condition', 'role');
        $partitioned = $users->partition(fn($user) => $user->{$partitionBy} === 'admin');
        return response()->json($partitioned);
    }

    public function percentage(Request $request)
    {
        $users = User::all();
        $key = $request->input('key', 'role');
        $percentage = $users->percentage($key);
        return response()->json(['percentage' => $percentage]);
    }

    public function pipe(Request $request)
    {
        $users = User::all();
        $pipe = $users->pipe(fn($collection) => $collection->pluck('name')->toArray());
        return response()->json(['pipeResult' => $pipe]);
    }

    public function pipeInto(Request $request)
    {
        $users = User::all();
        $pipeInto = $users->pipeInto(User::class);
        return response()->json($pipeInto);
    }

    public function pipeThrough(Request $request)
    {
        $users = User::all();
        $pipeThrough = $users->pipeThrough([
            fn($collection) => $collection->pluck('name'),
            fn($collection) => $collection->map(fn($name) => strtoupper($name)),
        ]);
        return response()->json(['pipeThroughResult' => $pipeThrough]);
    }

    public function pluck(Request $request)
    {
        $users = User::all();
        $key = $request->input('key', 'name');
        $pluck = $users->pluck($key);
        return response()->json(['pluckResult' => $pluck]);
    }

    public function pop()
    {
        $users = User::all();
        $lastUser = $users->pop();
        return response()->json(['lastUser' => $lastUser]);
    }




    public function appendAttribute(Request $request)
    {
        $attribute = "FullName";

        $users = User::all();

        $updatedUsers = $users->appendAttribute($attribute);
        return response()->json($users);
    }

    public function expectId(Request $request)
    {
        $id = $request->input('id');

        $users = User::all();
        $usersExceptId = $users->expectId($id);
        return response()->json($usersExceptId);
    }

    public function findById(Request $request)
    {
        $id = $request->input('id');

        $users = User::all();
        $user = $users->findById($id);
        return response()->json($user);
    }

    public function findOrFailById(Request $request)
    {
        $id = $request->input('id');

        $users = User::all();
        $user = $users->findOrFailById($id);
        return response()->json($user);
    }

    public function intersectWithAdmins()
    {
        $users = User::all();
        $intersectWithAdmins = $users->intersectWithAdmins();
        return response()->json($intersectWithAdmins);
    }

    public function loadPosts()
    {
        $users = User::all();
        $usersWithPosts = $users->loadPosts();
        return response()->json($usersWithPosts);
    }

    public function loadMissingPosts()
    {
        $users = User::all();
        $usersWithPosts = $users->loadMissingPosts();
        return response()->json($usersWithPosts);
    }

    public function getModelKeys()
    {
        $users = User::all();
        $modelKeys = $users->getModelKeys();
        return response()->json($modelKeys);
    }

    public function makeVisibleEmail()
    {
        $users = User::all();
        $usersWithVisibleEmail = $users->makeVisibleEmail();
        return response()->json($usersWithVisibleEmail);
    }

    public function makeHiddenEmail()
    {
        $users = User::all();
        $usersWithHiddenEmail = $users->makeHiddenEmail();
        return response()->json($usersWithHiddenEmail);
    }

    public function onlyIds()
    {
        $users = User::all();
        $onlyIds = $users->onlyIds();
        return response()->json($onlyIds);
    }

    public function setVisibleAttributes()
    {
        $attributes = ['first_name', 'last_name'];

        $users = User::all();
        $usersWithVisibleAttributes = $users->setVisibleAttributes($attributes);
        return response()->json($usersWithVisibleAttributes);
    }

    public function setHiddenAttributes()
    {
        $attributes = ['first_name', 'last_name'];

        $users = User::all();
        $usersWithHiddenAttributes = $users->setHiddenAttributes($attributes);
        return response()->json($usersWithHiddenAttributes);
    }

    public function toQueryActiveUsers()
    {
        $users = User::all();
        $activeUsers = $users->toQueryActiveUsers();
        return response()->json($activeUsers);
    }

    public function uniqueEmails()
    {
        $users = User::all();
        $uniqueEmails = $users->uniqueEmails();
        return response()->json($uniqueEmails);
    }
    
}