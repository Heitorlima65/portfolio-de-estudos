using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace aulaHerança
{
    internal class Program
    {
        static void Main(string[] args)
        {
            Animal A = new Animal();
            Gato G = new Gato();
            Calopsita C = new Calopsita();
            A.Nome = "Bob";
            A.Som = "gugaw";
            G.Nome = "felix";
            G.Som = "miau";
            G.Cor = "PRETO";
            C.Nome = "Clara";
            C.Som = "piupiu";

            Console.WriteLine("Executando métodos do animal");
            Console.ReadKey();
            Console.Clear();

            Console.WriteLine(A.Comer());
            Console.WriteLine(A.EmitirSom());
            Console.ReadKey();
            Console.Clear();

            Console.WriteLine("Executando métodos do animal");
            Console.ReadKey();
            Console.Clear();

            Console.WriteLine(G.Comer());
            Console.WriteLine(G.EmitirSom());
            Console.WriteLine(G.cacar());
            Console.ReadKey();
            Console.Clear();

            Console.WriteLine("Executando métodos do animal");
            Console.ReadKey();
            Console.Clear();

            Console.WriteLine(C.Comer());
            Console.WriteLine(C.EmitirSom());
            Console.WriteLine("quantos ovos " + C.Nome + " irá botar?");
            C.Ovos = int.Parse(Console.ReadLine());
            Console.WriteLine(C.botar());
            Console.ReadKey();

        }
    }
}
