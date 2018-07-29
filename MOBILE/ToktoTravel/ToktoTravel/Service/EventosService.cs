using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using ToktoTravel.Model;

namespace ToktoTravel.Service
{
    public class EventosService
    {
        public List<Evento> _locais;

        public async Task<List<Evento>> Localiza()
        // {
        /*if (string.IsNullOrWhiteSpace(local))
        {
            return null;
        }*/
        //else
        {
            using (var client = new HttpClient())
            {
                var json = await client.GetStringAsync("http://izaiasalexandre13.000webhostapp.com/MVCv5/WS/ConsultaWSE.php");
                var livros = JsonConvert.DeserializeObject<List<Evento>>(json);
                _locais = new List<Evento>(livros);
                // Console.Write(json);

            }



            return _locais;
        }
    }
}

