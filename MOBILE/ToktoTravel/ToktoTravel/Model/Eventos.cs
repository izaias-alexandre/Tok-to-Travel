using System;
using System.Collections.Generic;
using System.Text;
using System.Linq;
using System.Threading.Tasks;
using System.ComponentModel;
using Newtonsoft.Json;

namespace ToktoTravel.Model
{
    public class Eventos : INotifyPropertyChanged
    {
        private int cod_evento;
        public int Cod_evento { get { return cod_evento; } set { cod_evento = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(cod_evento))); } }

        private string nome_evento;
        public string Nome_evento { get { return nome_evento; } set { nome_evento = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(nome_evento))); } }

        private string evento_end;
        public string Evento_end { get { return evento_end; } set { evento_end = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(evento_end))); } }

        private string evento_nro;
        public string Evento_nro { get { return evento_nro; } set { evento_nro = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(evento_nro))); } }

        private string desc_evento;
        public string Desc_evento { get { return desc_evento; } set { desc_evento = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(desc_evento))); } }

        private string evento_CEP;
        public string Evento_CEP { get { return evento_CEP; } set { evento_CEP = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(evento_CEP))); } }

        private string evento_bairro;
        public string Evento_bairro { get { return evento_bairro; } set { evento_bairro = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(evento_bairro))); } }

        private string nome_img_evento;
        public string Nome_img_evento { get { return nome_img_evento; } set { nome_img_evento = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(nome_img_evento))); } }

        private string evento_cidade;
        public string Evento_cidade { get { return evento_cidade; } set { evento_cidade = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(evento_cidade))); } }

        private string data_evento;
        public string Data_evento { get { return data_evento; } set { data_evento = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(data_evento))); } }

        private string hr_evento;
        public string Hr_evento { get { return hr_evento; } set { hr_evento = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(hr_evento))); } }

        private string avaliacao;
        public string Avaliacao { get { return avaliacao; } set { avaliacao = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(avaliacao))); } }

        private string nota;
        public string Nota { get { return nota; } set { nota = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(nota))); } }

        public event PropertyChangedEventHandler PropertyChanged;
    }
}
