<?php 
namespace App\Controller;

use App\Core\abstract\AbstractController;
use App\Core\App;
use App\Core\Validator;
use App\service\InscriptionService;

class InscriptionController extends AbstractController {
    private Validator $validator;
    private InscriptionService $inscriptionService;
    
    public function __construct() {
        parent::__construct();
        $this->Layout = 'login';
        $this->inscriptionService = App::getDependence('inscriptionService');
        $this->validator = App::getDependence('validator');
    }
    
    public function create() {
        $this->render('login/inscription.php');
    }
    
    public function store() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $data = $_POST;
        
        // Ajout du champ 'idprofil' avec une valeur par défaut
        if (!isset($data['idprofil'])) {
            $data['idprofil'] = 2;
        }
        
        $rules = $this->validator::getInscriptionRules();
        
        if ($this->validator::validate($data, $rules)) {
            try {
                // Gestion de l'upload des images
                $imageService = App::getDependence('imageService');
                $photoRecto = '';
                $photoVerso = '';
                
                if (isset($_FILES['photo_recto']) && $_FILES['photo_recto']['error'] === UPLOAD_ERR_OK) {
                    $photoRecto = $imageService->uploadImage($_FILES['photo_recto']);
                    if ($photoRecto === false) {
                        $this->set('error', 'Erreur lors de l\'upload de la photo recto');
                        $this->render('login/inscription.php');
                        return;
                    }
                }
                
                if (isset($_FILES['photo_verso']) && $_FILES['photo_verso']['error'] === UPLOAD_ERR_OK) {
                    $photoVerso = $imageService->uploadImage($_FILES['photo_verso']);
                    if ($photoVerso === false) {
                        $this->set('error', 'Erreur lors de l\'upload de la photo verso');
                        $this->render('login/inscription.php');
                        return;
                    }
                }
                
                $userData = [
                    'nom' => $data['nom'],
                    'prenom' => $data['prenom'],
                    'login' => $data['telephone'],
                    'password' => $data['password'],
                    'adresse' => $data['adresse'],
                    'numerocni' => $data['numerocni'],
                    'photorecto' => $photoRecto,
                    'photoverso' => $photoVerso,
                    'idprofil' => (int)$data['idprofil']
                ];
                
                $result = $this->inscriptionService->inscrireUtilisateur(
                    $userData,
                    $data['telephone'],
                    1000.0
                );
                
                if ($result) {
                    $this->session->set('success', 'Inscription réussie !');
                    header("Location: " . APP_URL . "/");
                    exit;
                } else {
                    $this->set('error', 'Erreur lors de l\'inscription');
                }
            } catch (\Exception $e) {
                $this->set('error', $e->getMessage());
            }
        } else {
            $this->set('error', $this->validator::getError());
        }
    }
    
    $this->render('login/inscription.php');
}
    public function index() {}
    public function show() {}
    public function edit() {}
}