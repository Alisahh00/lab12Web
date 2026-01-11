<?php
class Form {
    protected $fields = [];
    protected $submit;
    protected $action;

    public function __construct($action, $submit) {
        $this->action = $action;
        $this->submit = $submit;
    }

    public function addField($name, $label, $type = "text") {
        $this->fields[] = ['name' => $name, 'label' => $label, 'type' => $type];
    }

    public function displayForm() {
        echo "<form action='".$this->action."' method='POST'>";
        foreach ($this->fields as $field) {
            echo "<div class='mb-3'>";
            echo "<label class='form-label'>".$field['label']."</label>";
            echo "<input type='".$field['type']."' name='".$field['name']."' class='form-control'>";
            echo "</div>";
        }
        echo "<button type='submit' class='btn btn-primary'>".$this->submit."</button>";
        echo "</form>";
    }
}
?>