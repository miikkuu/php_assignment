<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UserService
{
    private $entityManager;
    private $userRepository;
    private $emailService;

    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository, EmailService $emailService)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->emailService = $emailService;
    }

    public function processUploadedFile(UploadedFile $file): array
    {
        $csvData = array_map('str_getcsv', file($file->getPathname()));
        array_shift($csvData); // Remove header row

        foreach ($csvData as $row) {
            $user = new User();
            $user->setName($row[0]);
            $user->setEmail($row[1]);
            $user->setUsername($row[2]);
            $user->setAddress($row[3]);
            $user->setRole($row[4]);

            $this->entityManager->persist($user);
            $this->emailService->sendUserDataStoredEmail($user->getEmail());
        }

        $this->entityManager->flush();

        return ['message' => 'Data uploaded successfully'];
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->findAllAsArray();
    }
}