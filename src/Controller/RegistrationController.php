<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Security\EmailVerifier;
use Symfony\Component\Mime\Address;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/signup', name: 'app_register')]
    public function register(CountryRepository $country): Response
    {
   
        return $this->render('registration/signup.html.twig', [
            'african_countries' => $country->getAllAfricanCountry(),
            'american_countries' => $country->getAllAmericanCountry(),
            'asian_countries' => $country->getAllAsianCountry(),
            'european_countries' => $country->getAllEuropeanCountry(),
            'oceanian_countries' => $country->getAllOceanianCountry()
        ]);
    }

    #[Route('/signup/handler', name:'register_handler')]
    public function register_handler(CountryRepository $countryRepo, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager){

            $user = new User;

            $user->setEmail($_POST['email-address']);
            $user->setFirstname($_POST['firstname']);
            $user->setLastname($_POST['lastname']);
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $_POST['password']
                )
                );
            $user->setCountry($countryRepo->find($_POST['country']));
            $user->setAddress($_POST['address']);
            $user->setBuildingFloor($_POST['building-floor']);
            $user->setCity($_POST['city']);
            $user->setPostcode($_POST['postcode']);
            $user->setPhone($_POST['phone']);
            $user->setBirthdate( $_POST['birth-date']);
            $user->setCreationDate(new DateTime());
            $user->setTermsOfUse($_POST['termsOfUse']);
    
                $entityManager->persist($user);
                $entityManager->flush();



            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('christopherprojects.mail@gmail.com', 'Christopher\'s Shop'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            return new Response('user created successfully', 200);
        }


        #[Route('/verify/email', name: 'app_verify_email')]
        public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
        {
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    
            // validate email confirmation link, sets User::isVerified=true and persists
            try {
                $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
            } catch (VerifyEmailExceptionInterface $exception) {
                $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));
    
                return $this->redirectToRoute('app_register');
            }
    
            // @TODO Change the redirect on success and handle or remove the flash message in your templates
            $this->addFlash('success', 'Your email address has been verified.');
    
            return $this->redirectToRoute('app_register');
        }


    }


