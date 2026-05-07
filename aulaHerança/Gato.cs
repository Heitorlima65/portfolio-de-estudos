using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace aulaHerança
{
    internal class Gato:Animal
    {
        private string cor;

        public string Cor 
        { 
            get => cor; 
            set => cor = value; 
        }

        public string cacar()
        {
            if (cor.ToUpper() == "verde")
            {
                return Nome + "está caçando humanos";
            }
            else
            {
                return Nome + "está caçando baratas";
            }
        }
    }
}
