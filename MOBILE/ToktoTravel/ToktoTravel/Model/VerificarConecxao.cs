using Plugin.Connectivity;
using System;
using System.Collections.Generic;
using System.Text;

namespace ToktoTravel.Model
{
    public class VerificarConecxao
    {
        public Boolean conn;
        public  VerificarConecxao()
        {
            if (CrossConnectivity.Current.IsConnected)
            {
                conn = true;
            }
            else
            {
                conn = false;
            }
        }
    }
}
