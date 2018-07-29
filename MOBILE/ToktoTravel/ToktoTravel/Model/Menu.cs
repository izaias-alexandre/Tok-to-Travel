using System;
using System.Collections.Generic;
using System.Text;

namespace ToktoTravel.Model
{
    public class Menu
    {
        private string nome;
        private string descricao;
        private string logo;

        public string Nome { get => nome; set => nome = value; }
        public string Logo { get => logo; set => logo = value; }
        public string Descricao { get => descricao; set => descricao = value; }
    }
}
