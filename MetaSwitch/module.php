<?php

    // Klassendefinition
    class MetaSwitch extends IPSModule {
 
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
		$this->RegisterPropertyString("Sender","MetaSwitch");
		$this->RegisterPropertyInteger("RefreshInterval",0);

		// Variables
		$this->RegisterVariableBoolean("Status","Status","~Switch");
		$this->RegisterVariableString("Devices","Devices");

		$this->RegisterTimer("RefreshInformation", 0 , 'METASWITCH_RefreshInformation($_IPS[\'TARGET\']);');

        }

	public function Destroy() {

		// Never delete this line
		parent::Destroy();
	}
 
        // Überschreibt die intere IPS_ApplyChanges($id) Funktion
        public function ApplyChanges() {

		
		$newInterval = $this->ReadPropertyInteger("RefreshInterval") * 1000;
		$this->SetTimerInterval("RefreshInformation", $newInterval);
		

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

		// Let us assume that alls is off
		$status = false;
	
		$allDevices = $this->GetDevices();

		foreach ($allDevices as $currentDevice) {
		
			// If one device is on we set the status to on
			if (GetValue($currentDevice) ) {
			
				$status = true;	
				// As we have found a single switch on device we can stop processing the loop
				break;
			}
		}

		SetValue($this->GetIDForIdent("Status"), $status);

	}

	public function SwitchOn() {
	
	
	}

	public function SwitchOff() {
	
	
	}

	protected function GetDevices() {
	
		$allLinks = IPS_GetChildrenIDs($this->GetIDForIdent("Devices"));

		$allDevices = Array();

		foreach ($allLinks as $currentLink) {
		
			$currentLinkDetails = IPS_GetLink($currentLink);
			$allDevices[] = $currentLinkDetails['TargetID'];
		}

		return $allDevices;
	}

    }
?>
