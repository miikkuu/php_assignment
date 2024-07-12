<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;
use App\Service\DatabaseService;

class UserController extends AbstractController
{
    private $userService;
    private $databaseService;

    public function __construct(UserService $userService, DatabaseService $databaseService)
    {
        $this->userService = $userService;
        $this->databaseService = $databaseService;
    }

    /**
     * @Route("/api/upload", name="upload_data", methods={"POST"})
     */
    public function uploadData(Request $request): JsonResponse
    {
        $file = $request->files->get('file');

        if (!$file) {
            return new JsonResponse(['error' => 'No file uploaded'], 400);
        }

        $result = $this->userService->processUploadedFile($file);

        return new JsonResponse($result);
    }

    /**
     * @Route("/api/users", name="view_users", methods={"GET"})
     */
    public function viewUsers(): JsonResponse
    {
        $users = $this->userService->getAllUsers();
        return new JsonResponse($users);
    }

    /**
     * @Route("/api/backup", name="backup_database", methods={"GET"})
     */
    public function backupDatabase(): JsonResponse
    {
        $result = $this->databaseService->backup();
        return new JsonResponse($result);
    }

    /**
     * @Route("/api/restore", name="restore_database", methods={"POST"})
     */
    public function restoreDatabase(Request $request): JsonResponse
    {
        $file = $request->files->get('backup_file');

        if (!$file) {
            return new JsonResponse(['error' => 'No backup file provided'], 400);
        }

        $result = $this->databaseService->restore($file);
        return new JsonResponse($result);
    }
}
