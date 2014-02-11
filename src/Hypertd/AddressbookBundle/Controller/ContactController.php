<?php

namespace Hypertd\AddressbookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hypertd\AddressbookBundle\Entity\Contact;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
	/**
     * @Route("/addressbook/contact")
     */
    public function indexAction()
    {
    	$repository = $this->getDoctrine()
		->getRepository('HypertdAddressbookBundle:Contact');
		
		$contacts = $repository->findAll();
		
        $response = new Response();
		$response->headers->set('Content-Type', 'xml');
		return $this->render('HypertdAddressbookBundle:Addressbook:contact.xml.php', array("contacts" => $contacts), $response);
    }
		
	/**
     * @Route("/addressbook/contact/create")
     */
    public function createAction(Request $request)
    {
    	$firstname = $request->request->get('firstname'); // get a $_POST parameter
    	$lastname = $request->request->get('lastname'); // get a $_POST parameter
    	$city = $request->request->get('city'); // get a $_POST parameter
    	$address1 = $request->request->get('address_1'); // get a $_POST parameter
    	$address2 = $request->request->get('address_2'); // get a $_POST parameter
    	$postal = $request->request->get('postal'); // get a $_POST parameter
    	$tel = $request->request->get('tel_home'); // get a $_POST parameter
    	$tel2 = $request->request->get('tel_mobile'); // get a $_POST parameter
    	
        $contact = new Contact();
		
		//set firstname
		if(isset($firstname) && !empty($firstname)){
			$contact->setFirstname($firstname);	
		}
		else{
			$contact->setFirstname("");
		}
		
		//set lastname
		if(isset($lastname) && !empty($lastname)){
			$contact->setLastname($lastname);	
		}
		else{
			$contact->setLastname("");
		}
		
		//set city
		if(isset($city) && !empty($city)){
			$contact->setCity($city);	
		}
		else{
			$contact->setCity("");
		}
		
		if(isset($address1) && !empty($address1)){
			$contact->setAddress1($address1);	
		}
		else{
			$contact->setAddress1("");
		}
		
		if(isset($address2) && !empty($address2)){
			$contact->setAddress2($address2);	
		}
		else{
			$contact->setAddress2("");
		}
		
		if(isset($postal) && !empty($postal)){
			$contact->setPostal($postal);	
		}
		else{
			$contact->setPostal("");
		}
		
		if(isset($tel) && !empty($tel)){
			$contact->setTel($tel);	
		}
		else{
			$contact->setTel("");
		}
		
		if(isset($tel2) && !empty($tel2)){
			$contact->setTel2($tel2);	
		}
		else{
			$contact->setTel2("");
		}

		$em = $this->getDoctrine()->getManager();
		$em->persist($contact);
		$em->flush();
		
		return new Response();
    }

	
	/**
     * @Route("/addressbook/contact/update")
     */
    public function editAction(Request $request)
    {
    	$firstname = $request->request->get('firstname'); // get a $_POST parameter
    	$lastname = $request->request->get('lastname'); // get a $_POST parameter
    	$city = $request->request->get('city'); // get a $_POST parameter
    	$address1 = $request->request->get('address_1'); // get a $_POST parameter
    	$address2 = $request->request->get('address_2'); // get a $_POST parameter
    	$postal = $request->request->get('postal'); // get a $_POST parameter
    	$tel = $request->request->get('tel_home'); // get a $_POST parameter
    	$tel2 = $request->request->get('tel_mobile'); // get a $_POST parameter
    	
        $em = $this->getDoctrine()->getManager();
		$contact = $em->getRepository('HypertdAddressbookBundle:Contact')->find($request->request->get('id'));
		
		if ($contact) {
			if(isset($firstname) && !empty($firstname)){
				$contact->setFirstname($firstname);	
			}
			
			if(isset($lastname) && !empty($lastname)){
				$contact->setLastname($lastname);	
			}
			//set city
			if(isset($city) && !empty($city)){
				$contact->setCity($city);	
			}
			
			if(isset($address1) && !empty($address1)){
				$contact->setAddress1($address1);	
			}
			
			if(isset($address2) && !empty($address2)){
				$contact->setAddress2($address2);	
			}
			
			if(isset($postal) && !empty($postal)){
				$contact->setPostal($postal);	
			}
			
			if(isset($tel) && !empty($tel)){
				$contact->setTel($tel);	
			}
			
			if(isset($tel2) && !empty($tel2)){
				$contact->setTel2($tel2);	
			}
			
			$em->flush();
		}
		
		return new Response();
    }

	/**
     * @Route("/addressbook/contact/delete")
     */
    public function deleteAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$contact = $em->getRepository('HypertdAddressbookBundle:Contact')->find($request->request->get('id'));
		$em->remove($contact);
		$em->flush();
		
		return new Response();
    }
}
