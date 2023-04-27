<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class UserManager
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher,
        private Security $security
    ) {
    }

    public function create(string $email, string $password, array $roles, string $firstName, string $lastName): ?User
    {
        $existingUser = $this->existingUser($email);

        if ($existingUser) {
            return null;
        }

        $user = new User();

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $password
        );

        $user
            ->setEmail($email)
            ->setPassword($hashedPassword)
            ->setRoles($roles)
            ->setFirstName($firstName)
            ->setLastName($lastName)
        ;

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function getLoggedUser(): ?UserInterface
    {
        return $this->security->getUser();
    }

    private function existingUser(string $email): ?User
    {
        return $this->userRepository->findOneBy(['email' => $email]);
    }
}
