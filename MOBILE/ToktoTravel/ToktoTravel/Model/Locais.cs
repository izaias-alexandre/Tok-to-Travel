using System;
using System.Collections.Generic;
using System.Text;
using System.Linq;
using System.Threading.Tasks;
using System.ComponentModel;
using Newtonsoft.Json;

namespace ToktoTravel.Model
{
    public class Locais : INotifyPropertyChanged
    {
        
        private int cod_local;
        public int Cod_local { get { return cod_local; } set { cod_local = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(cod_local))); } }
        private string nome_loc;
        public string Nome_loc { get { return nome_loc; } set { nome_loc = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(nome_loc))); } }

        private string end_loc;
        public string End_loc { get { return end_loc; } set { end_loc = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(end_loc))); } }

        private string nro_loc;
        public string Nro_loc { get { return nro_loc; } set { nro_loc = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(nro_loc))); } }

        private string desc_local;
        public string Desc_local { get { return desc_local; } set { desc_local = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(desc_local))); } }

        private string cep_loc;
        public string Cep_loc { get { return cep_loc; } set { cep_loc = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(cep_loc))); } }

        private string bairro_loc;
        public string Bairro_loc { get { return bairro_loc; } set { bairro_loc = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(bairro_loc))); } }

        private string nome_img_loc;
        public string Nome_img_loc { get { return nome_img_loc; } set { nome_img_loc = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(nome_img_loc))); } }

        private string cidade_loc;
        public string Cidade_loc { get { return cidade_loc; } set { cidade_loc = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(cidade_loc))); } }

        /* private TipoLocais tipo;*/
        /* public TipoLocais Tipo { get { return tipo ; } set { tipo = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(tipo))); } }*/

        private string avaliacao;
        public string Avaliacao { get { return avaliacao; } set { avaliacao = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(avaliacao))); } }

        private string nota;
        public string Nota { get { return nota; } set { nota = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(nota))); } }


        public event PropertyChangedEventHandler PropertyChanged;
    }
}
