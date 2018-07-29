using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Text;

namespace ToktoTravel.Model
{
    public class Local
    {
        [JsonProperty("nome_loc")]
        public string Nome_loc { get; set; }
        [JsonProperty("end_loc")]
        public string End_loc { get; set; }
        [JsonProperty("nome_img_loc")]
        public string Imagem { get; set; }
        [JsonProperty("cod_local")]
        public string Cod_local { get; set; }
        [JsonProperty("desc_local")]
        public string Desc_local { get; set; }
        [JsonProperty("nro_loc")]
        public string Nro_loc { get; set; }
        [JsonProperty("cep_loc")]
        public string Cep_loc { get; set; }
        [JsonProperty("bai_loc")]
        public string Bai_loc { get; set; }
        [JsonProperty("cidade_loc")]
        public string Cidade_loc { get; set; }
    }
}
