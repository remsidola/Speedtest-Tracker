<?php

namespace App\Http\Controllers;

use App\Helpers\SettingsHelper;
use Exception;
use Healthcheck;
use Henrywhitaker3\Healthchecks\Exceptions\HealthchecksUuidNotFoundException;
use Henrywhitaker3\Healthchecks\Healthchecks;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Exception\InvalidUuidStringException;

class IntegrationsController extends Controller
{
    /**
     * Test the healthchecks config
     *
     * @return JsonResponse
     */
    public function testHealthchecks(String $method)
    {
        $methodResp = 'test healthchecks \'' . $method . '\' endpoint';

        try {
            $hc = new Healthchecks(config('integrations.healthchecks_uuid'));
            if($method == 'success') {
                $hc->success();
            }

            if($method == 'fail') {
                $hc->fail();
            }

            if($method == 'start') {
                $hc->start();
            }

            return response()->json([
                'method' => $methodResp,
                'success' => true
            ], 200);
        } catch(InvalidUuidStringException $e) {
            return response()->json([
                'method' => $methodResp,
                'success' => false,
                'error' => 'Invalid UUID'
            ], 422);
        } catch(HealthchecksUuidNotFoundException $e) {
            return response()->json([
                'method' => $methodResp,
                'success' => false,
                'error' => 'UUID not found'
            ], 404);
        } catch(Exception $e) {
            return response()->json([
                'method' => $methodResp,
                'success' => false,
                'error' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Trigger a test of all notification agents
     *
     * @return JsonResponse
     */
    public function testNotification()
    {
        SettingsHelper::testNotification();

        return response()->json([
            'method' => 'test notificaiton agents'
        ], 200);
    }
}
