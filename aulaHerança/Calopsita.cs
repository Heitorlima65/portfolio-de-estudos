using System;
using System.Collections.Generic;
using System.Linq;
using System.Security.Principal;
using System.Text;
using System.Threading.Tasks;

namespace aulaHerança
{
    internal class Calopsita:Animal
    {
        private string tamanhoTopete;
        private int ovos;

        public string TamanhoTopete 
        { 
            get => tamanhoTopete; 
            set => tamanhoTopete = value; 
        }
        public int Ovos 
        {
            get => ovos; 
            set => ovos = value; 
        }

        public string botar()
        {
            if (ovos <= 10)
            {
                return Nome + " botou " + ovos;
            }
            else
            {
                return Nome + " o limite de ovos é 10 ou menos ";
            }
        }
    }
}
