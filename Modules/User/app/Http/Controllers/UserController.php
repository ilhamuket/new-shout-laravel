<?php

namespace Modules\User\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\Services\UserServiceInterface;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class UserController extends Controller
{
    protected $user_svc;
    public function __construct(UserServiceInterface $user_svc) {
        $this->user_svc = $user_svc;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $entities = $request->entities;
            $since = $request->since;
            $until = $request->until;
            $limit = $request->input('limit', 5);

            $params = [
                'entities' => $entities,
                'since' => $since,
                'until' => $until,
                'limit' => $limit,
            ];
            $user = $this->user_svc->get_all($params);

            return ResponseFormatter::success($user, 'success', 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ResponseFormatter::error('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return ResponseFormatter::error('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return ResponseFormatter::error('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch(RouteNotFoundException $e) {
            return ResponseFormatter::error('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    private function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('user::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
