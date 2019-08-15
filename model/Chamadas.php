<?php 

    class Chamada {

        private $id;
        private $codCurso;
        private $data;
        private $horaInicial;
        private $horaFinal;

    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodCurso()
    {
        return $this->codCurso;
    }

    /**
     * @param mixed $codCurso
     *
     * @return self
     */
    public function setCodCurso($codCurso)
    {
        $this->codCurso = $codCurso;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     *
     * @return self
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHoraInicial()
    {
        return $this->horaInicial;
    }

    /**
     * @param mixed $horaInicial
     *
     * @return self
     */
    public function setHoraInicial($horaInicial)
    {
        $this->horaInicial = $horaInicial;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHoraFinal()
    {
        return $this->horaFinal;
    }

    /**
     * @param mixed $horaFinal
     *
     * @return self
     */
    public function setHoraFinal($horaFinal)
    {
        $this->horaFinal = $horaFinal;

        return $this;
    }
}
