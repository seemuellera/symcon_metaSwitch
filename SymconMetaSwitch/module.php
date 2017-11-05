<?php

    // Klassendefinition
    class SymconMetaSwitch extends IPSModule {
 
        // Der Konstruktor des Moduls
        // Überschreibt den Standard Kontruktor von IPS
        public function __construct($InstanceID) {
            // Diese Zeile nicht löschen
            parent::__construct($InstanceID);
 
            // Selbsterstellter Code
        }
 
        // Überschreibt die interne IPS_Create($id) Funktion
        public function Create() {
            
		// Diese Zeile nicht löschen.
            	parent::Create();

		// Properties
		$this->RegisterPropertyString("Sender","SymconMetaSwitch");
		$this->RegisterPropertyInteger("RefreshInterval",5);

		// Timer
		$this->RegisterTimer("RefreshInformation", 60, "METASWITCH_RefreshInformation($id);");
 
        }
 
        // Überschreibt die intere IPS_ApplyChanges($id) Funktion
        public function ApplyChanges() {
            // Diese Zeile nicht löschen
            parent::ApplyChanges();
        }


	public function GetConfigurationForm() {

        	
		// Initialize the form
		$form = Array(
            		"elements" => Array(),
			"actions" => Array()
        		);

		// Add the Elements
		$form['elements'][] = Array("type" => "NumberSpinner", "name" => "RefreshInterval", "caption" => "Refresh Interval");
		

		// Add the buttons for the test center
		$form['actions'][] = Array("type" => "Button", "label" => "Refresh Overall Status", "onClick" => 'METASWITCH_RefreshInformation($id);');
		$form['actions'][] = Array("type" => "Button", "label" => "Switch On", "onClick" => 'METASWITCH_SwitchOn($id);');
		$form['actions'][] = Array("type" => "Button", "label" => "Switch Off", "onClick" => 'METASWITCH_SwitchOff($id);');

		// Return the completed form
		return json_encode($form);

	}

	public function RefreshInformation() {
	
		
	}

	public function SwitchOn() {
	
	
	}

	public function SwitchOff() {
	
	
	}

    }
?>
