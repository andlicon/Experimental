<?php
    class Post {
        private $autor;
        private $personaDestino;
        private $titulo;
        private $contenido;

        public function __construct($autor, $personaDestino, $titulo, $contenido) {
            $this->autor = $autor;
            $this->personaDestino = $personaDestino;
            $this->titulo = $titulo;
            $this->contenido = $contenido;
        }

        public function getAutor() {
            return $this->autor;
        }
        public function getPersonaDestino() {
            return $this->personaDestino;
        }
        public function getTitulo() {
            return $this->titulo;
        }
        public function getContenido() {
            return $this->contenido;
        }
        
    }
?>