<?php

namespace Ijodkor\Guard\Http\Middlewares;

use Closure;
use Exception;
use Ijodkor\ApiResponse\Responses\RestResponse;
use Ijodkor\Guard\Entities\RoleLevelEntity;
use Ijodkor\Guard\Models\Organization;
use Ijodkor\Guard\Services\OrganizationService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrganizationHasMiddleware {
    use RestResponse;

    public function __construct(private OrganizationService $organizationService) { }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws Exception
     */
    public function handle(Request $request, Closure $next): Response {
        /**
         * @var Organization $organization
         */

        $id = $request->get('organization_id');
        $userRole = $request->get('role');
        $level = $userRole->role?->level;

        if ($level <= RoleLevelEntity::REPUBLIC) {
            $organization = $this->organizationService->get($id);
        } else {
            $organization = $userRole->organization;
            if ($organization == null) {
                return $this->fail([], 'Organization not found.');
            }
        }

        // Add attribute to request
        $request->attributes->add([
            'organization' => $organization,
            'level' => $level,
        ]);

        return $next($request);
    }
}
