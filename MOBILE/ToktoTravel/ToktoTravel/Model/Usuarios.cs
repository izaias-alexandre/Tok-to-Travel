using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Text;

namespace ToktoTravel.Model
{
    public class Usuarios : INotifyPropertyChanged
    {
        private string id_user;
        public string Id_user { get { return id_user; } set { id_user = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(id_user))); } }

        private string email_user;
        public string Email_user { get { return email_user; } set { email_user = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(email_user))); } }

        private string senha_user;
        public string Senha_user { get { return senha_user; } set { senha_user = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(senha_user))); } }

        private string nome_user;
        public string Nome_user { get { return nome_user; } set { nome_user = value; this.PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(nome_user))); } }

        public event PropertyChangedEventHandler PropertyChanged;
    }
}
