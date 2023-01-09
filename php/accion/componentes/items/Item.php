<?php
    abstract class Item {
        //Atributos
        protected $id;
        protected $name;
        protected $class;

        //Constructores
        public function __construct($id, $name, $class) {
            $this->id = $id;
            $this->name = $name;
            $this->class = $cñass;
        }

        //Getters
        public function getId() {
            return $this->id;
        }
        public function getName() {
            return $this->name;
        }
        public function getClass() {
            return $this->class;
        }
    }
?>