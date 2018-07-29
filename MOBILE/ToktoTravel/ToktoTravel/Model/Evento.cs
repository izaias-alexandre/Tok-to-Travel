using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Text;

namespace ToktoTravel.Model
{
    public class Evento
    {
        [JsonProperty("cod_evento")]
        public int Cod_evento { get; set; }

        [JsonProperty("nome_evento")]
        public string Nome_evento { get; set; }

        [JsonProperty("evento_end")]
        public string Evento_end { get; set; }

        [JsonProperty("evento_nro")]
        public string Evento_nro { get; set; }

        [JsonProperty("desc_evento")]
        public string Desc_evento { get; set; }

        [JsonProperty("evento_CEP")]
        public string Evento_CEP { get; set; }

        [JsonProperty("evento_bairro")]
        public string Evento_bairro { get; set; }

        [JsonProperty("nome_img_evento")]
        public string Nome_img_evento { get; set; }

        [JsonProperty("evento_cidade")]
        public string Evento_cidade { get; set; }

        [JsonProperty("data_evento")]
        public string Data_evento { get; set; }

        [JsonProperty("hr_evento")]
        public string Hr_evento { get; set; }

    }
}
