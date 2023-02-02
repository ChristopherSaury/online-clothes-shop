<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController{
    #[Route('/user/account/{id}', 'user_params')]
    #[IsGranted('ROLE_USER')]
    public function userParameters($id){
        if($this->getUser()->getId() != $id){
            return $this->redirectToRoute('error_403');
        }
        $data = $this->getUser();
        return $this->render('user/account.html.twig', compact('data'));
    }

    #[Route('/user/account/update/{id}', name:'user_update')]
    #[IsGranted('ROLE_USER')]
    public function updateUser($id, Request $request, EntityManagerInterface $em, CountryRepository $country){
        if($this->getUser()->getId() != $id){
            return $this->redirectToRoute('error_403');
        }
        $user = $this->getUser();
        $african_countries = $country->getAllAfricanCountry();
        $american_countries = $country->getAllAmericanCountry() ;
        $asian_countries = $country->getAllAsianCountry();
        $european_countries = $country->getAllEuropeanCountry();
        $oceanian_countries = $country->getAllOceanianCountry();

    return $this->render('user/update.html.twig', compact('user', 'african_countries',
    'american_countries', 'asian_countries', 'european_countries', 'oceanian_countries'));
        
    }

    #[Route('/user/account/update/handler/{id}', name:'user_update_handler')]
    #[IsGranted('ROLE_USER')]
    public function updateUserHandler(Request $request, $id, EntityManagerInterface $em, UserRepository $user, CountryRepository $country){

        $submittedToken = $request->request->get('token-upd');
        if($this->isCsrfTokenValid('update-user', $submittedToken) == false){
            $this->addFlash('tokenErr', 'Error token validation');
            return $this->redirect($this->generateUrl('user_update', array('id' => $id)));
        }else{
            $user_update = $user->find($id);

            if($_POST['lastname_update']) $user_update->setLastname($_POST['lastname_update']);
            if($_POST['firstname_update']) $user_update->setFirstname($_POST['firstname_update']);
            if($_POST['country_update']) $user_update->setCountry($country->find($_POST['country_update']));
            if($_POST['address_update']) $user_update->setAddress($_POST['address_update']);
            if($_POST['building-floor-update']) $user_update->setBuildingFloor($_POST['building-floor-update']);
            if($_POST['city_update']) $user_update->setCity($_POST['city_update']);
            if($_POST['postcode_update']) $user_update->setPostcode($_POST['postcode_update']);
            if($_POST['phone_update']) $user_update->setPhone($_POST['phone_update']);
            if($_POST['birth-date-update']) $user_update->setBirthdate($_POST['birth-date-update']);

            $em->persist($user_update);
            $em->flush();
            
            $this->addFlash('updSuccess', 'Account data updated successfully');
            return $this->redirect($this->generateUrl('user_update', array('id' => $id)));
        }
    }

    #[Route('/change/password/user/{id}', name:'user_change_psw')]
    #[IsGranted('ROLE_USER')]
    public function changePsw($id){
        if($this->getUser()->getId() != $id){
            return $this->redirectToRoute('error_403');
        }
        return $this->render('user/update-psw.html.twig');
    }

    #[Route('/change/password/user/handler/{id}', name:'user_change_psw_handler')]
    public function changePswHandler($id, Request $request, UserRepository $user, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher){
        $submittedToken = $request->get('token-new-psw');

        if($this->isCsrfTokenValid('new-psw', $submittedToken) == false){
            $this->addFlash('errPsw', 'Unvalid Token');
            return $this->redirect($this->generateUrl('user_change_psw', array('id' => $id)));
        }elseif(empty($_POST['newPsw1']) || empty($_POST['inputConfirm'])){
            $this->addFlash('errPsw', 'You must fill all the required fields');
            return $this->redirect($this->generateUrl('user_change_psw', array('id' => $id)));
        }elseif($_POST['newPsw1'] !== $_POST['inputConfirm']){
            $this->addFlash('errPsw', 'The new password and its confirmation must be identical');
            return $this->redirect($this->generateUrl('user_change_psw', array('id' => $id)));
        }elseif(strlen($_POST['newPsw1']) < 8 || strlen($_POST['inputConfirm']) < 8 
        || strlen($_POST['newPsw1']) > 30 || strlen($_POST['inputConfirm']) > 30){
            $this->addFlash('errPsw', 'The password must be between 8 and 30 characters');
            return $this->redirect($this->generateUrl('user_change_psw', array('id' => $id)));
        }else{
            $new_psw = $user->find($id);
            $new_psw->setPassword(
                $userPasswordHasher->hashPassword(
                    $new_psw,
                    $_POST['newPsw1']
                )
            );
            $em->persist($new_psw);
            $em->flush();
            
            $this->addFlash('successNewPsw', 'The password has been changed successfully');
            return $this->redirect($this->generateUrl('user_change_psw', array('id' => $id)));
        }
        return $this->redirect($this->generateUrl('user_change_psw', array('id' => $id)));
    }

    #[Route('/account/delete/{id}', name:'delete_acount')]
    #[IsGranted('ROLE_USER')]
    public function deleteAccount($id, UserRepository $userRepo){
        if($this->getUser()->getId() == $id){
            $userRepo->remove($this->getUser(), true);
            $session = new Session();
            $session->invalidate();
            
            return $this->redirectToRoute('app_logout');
        }else{
            return $this->redirectToRoute('error_403');
        }

        return $this->redirectToRoute('error_500');
       
    }
}