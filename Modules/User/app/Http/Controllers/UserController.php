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

class UserController extends Controller implements UserControllerInterface
{
    protected $user_svc;
    public function __construct(UserServiceInterface $user_svc)
    {
        $this->user_svc = $user_svc;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $user = $this->user_svc->get_all($request);
            return ResponseFormatter::success($user, 'success', 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ResponseFormatter::error('Error Model: ' . (env('APP_DEBUG', false) ? $e : ''));
        } catch (\Illuminate\Database\QueryException $e) {
            return ResponseFormatter::error('Error Query: ' . (env('APP_DEBUG', false) ? $e : ''));
        } catch (\ErrorException $e) {
            return ResponseFormatter::error('Error Exception: ' . (env('APP_DEBUG', false) ? $e : ''));
        } catch (RouteNotFoundException $e) {
            return ResponseFormatter::error('Route not found: ' . (env('APP_DEBUG', false) ? $e : ''), 404);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            // return ResponseFormatter::error('Token is invalid: ' . (env('APP_DEBUG', false) ? $e : ''), 401);
            return ResponseFormatter::error('Token is invalid: ' . $e, 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            // return ResponseFormatter::error('Token has expired: ' . (env('APP_DEBUG', false) ? $e : ''), 401);
            return ResponseFormatter::error('Token has expired: ' . $e, 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return ResponseFormatter::error('JWT error: ' . (env('APP_DEBUG', false) ? $e : ''), 401);
        } catch (\Exception $e) {
            return ResponseFormatter::error('Unexpected Error: ' . (env('APP_DEBUG', false) ? $e : ''));
        }
    }
}
