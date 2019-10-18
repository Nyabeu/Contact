<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02/03/2018
 * Time: 11:27
 */

class ContactForm
{
    /*
     * la clé est le name du champ de saisie
     */
    private $fields = [
        'firstname' => [
            'value' => null,
            'error' => "Vous n'avez pas saisi votre Prénom."
        ],
        'lastname' => [
            'value' => null,
            'error' => "Vous n'avez pas saisi votre Nom."
        ],
        'email' => [
            'value' => null,
            'error' => "Votre email est Incorrect"

        ],
        'php' => [
            'value' => null,
            'error' => "Vous n'avez pas saisi le nom du Champ"
        ],
        'hobbies' => [
            'value' => [],
            'error' => "Vous n'avez pas selectionné vos Loisirs."
        ],
        'country' => [
            'value' => null,
            'error' => "Vous n'avez pas selectionné vos Pays."
        ],
    ];
    private $message = [];
    // constructeur est appélé à chaque chargement de la page
    public function __construct()
    {
        //remplissage des champs
        //$this : ciblé un membre de la classe
        $this->fill();
        //validation si le formulaire a été soumis
        //utilisation de préférence des filtres de validation sinon filtres de netoyage(filter_sanitize_encoded)
        if(isset($_POST['submit'])){
            $this->validate();
        }
    }
    //methode
    private function validate(): void{
        $validation = filter_input_array(INPUT_POST, [
            'firstname' => FILTER_SANITIZE_STRING,
            'lastname' => FILTER_SANITIZE_STRING,
            'email' => FILTER_VALIDATE_EMAIL,
            'php' => FILTER_SANITIZE_STRING,
            'hobbies' => [
                'filter' => FILTER_SANITIZE_NUMBER_INT,
                'flags' => FILTER_REQUIRE_ARRAY
            ],
            'country' => FILTER_SANITIZE_STRING,
        ]);
        /*
         * valider chaque champ
         * clé : name du champ
         * valeur : résultat de la validation(true ou false)
         */
        foreach($validation as $field => $isValid)
        {
            //si la validation a échoué
            //if($isValid === false)
            if(!$isValid){
                array_push($this->message, $this->fields[$field]['error']);
            }
        }
        //formulaire valide
        if (empty($this->message)){
            $this->isvalid();
        }

    }
    private function isvalid():void{
        //affiche un message
        array_push($this->message,'Formulaire valide');
    }

    private function fill():void
    {
        //firstname
        //$_POST['firstname'] ?? null racourci php7 uniquement
        //$this->fields['firstname']['value'] = !empty($_POST['firstname']) ? $_POST['firstname'] : null;
        if (!empty($_POST['firstname'])){
            $this->fields['firstname']['value'] = filter_var($_POST['firstname'],FILTER_SANITIZE_STRING);
        }
        //lastname
        $this->fields['lastname']['value'] = !empty($_POST['lastname']) ?  filter_var($_POST['lastname'],
            FILTER_SANITIZE_STRING) : null;
        //email
        $this->fields['email']['value'] = !empty($_POST['email']) ?  filter_var($_POST['email'],
            FILTER_SANITIZE_EMAIL) : null;
        //php
        $this->fields['php']['value'] = !empty($_POST['php']) ?  filter_var($_POST['php'],
            FILTER_SANITIZE_STRING) : null;
        //loisirs
        $this->fields['hobbies']['value'] = !empty($_POST['hobbies']) ?  filter_var($_POST['hobbies'],
            FILTER_SANITIZE_NUMBER_INT,FILTER_REQUIRE_ARRAY) : [];
        //pays
        $this->fields['country']['value'] = !empty($_POST['country']) ?  filter_var($_POST['country'],
            FILTER_SANITIZE_STRING) : null;

    }

    public function checkRadio( string $field, string $value){
        return $this->fields[$field]['value'] === $value ? 'checked' : null;
    }
    public function checkBox(string $field, int $value){
        return in_array($value, $this->fields[$field]['value']) ? 'checked' : null;
    }
    public function selectOption( string $field, string $value){
        return $this->fields[$field]['value'] === $value ? 'selected' : null;
    }
    public function getFields(): array
    {
        return $this->fields;
    }

    public function getMessage(): array
    {
        return $this->message;
    }




}