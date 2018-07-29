using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Text;

namespace ToktoTravel.Model
{
    public class TipoLocais : INotifyPropertyChanged
    {

        private int id;
        public int Id { get { return id; } set { id = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(Id))); } }
        private string nome;

        public event PropertyChangedEventHandler PropertyChanged;

        public string Nome { get { return nome; } set { nome = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(nome))); } }
    }
}
