using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace aulaHerança
{
    internal class Animal
    {
        private string nome;
        private double peso = 2;
        private string som;

        public string Nome 
        { 
            get => nome; 
            set => nome = value; 
        }
        public double Peso 
        { 
            get => peso; 
        }
        public string Som 
        { 
            get => som; 
            set => som = value; 
        }

        public string EmitirSom()
        {
            return nome + " está fazendo " + som;
        }
        public string Comer()
        {
            peso++;
            return nome + " comeu 1kg e está pesando " + peso;
        }
    }
}
