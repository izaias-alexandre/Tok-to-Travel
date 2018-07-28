<?php

namespace api\imagens;

use lib\Model;

class apiImagens extends Model {

    public function carregarImagens() {
        $sql =  "SELECT * FROM locais INNER JOIN imagens ON locais.id_album = imagens.album_id_album WHERE imagens.tipo_album = 'local' and locais.fakedelete <> 1 GROUP BY locais.id_album" ;
        $query = $this->Select($sql);
        return $query;
    }

    public function carregarEventos() {
       $sql =  "SELECT * FROM eventos INNER JOIN imagens ON eventos.id_album = imagens.album_id_album WHERE imagens.tipo_album = 'evento' and eventos.fakedelete <> 1 GROUP BY eventos.id_album";
        $query = $this->Select($sql);
        return $query;
    }

    public function carregarFooter() {
        $sql = "SELECT * FROM eventos INNER JOIN imagens ON eventos.id_album = imagens.album_id_album where eventos.fakedelete <> 1 LIMIT 3";
        $query = $this->Select($sql);
        return $query;
    }

}
