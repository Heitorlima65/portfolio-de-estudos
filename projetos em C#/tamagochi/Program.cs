using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Threading;

namespace tamagochi_novo_
{
    internal class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Bem vindo(a) ao Tamagochi!\n");

            Thread.Sleep(1000);

            Console.WriteLine("Vamos criar um Tamagochi para você\n");

            Thread.Sleep(1000);

            Console.Write("Para começar, vamos definir um nome para ele, digite-o: ");
            Tamagochi tamagochi = new Tamagochi();
            tamagochi.Nome = Console.ReadLine();
            Thread.Sleep(1000);
            Console.Clear();

            Console.WriteLine("Clique em qualquer tecla para continuar com a criação de " + tamagochi.Nome);
            Console.ReadKey();
            Thread.Sleep(1000);
            Console.Clear();

            Console.WriteLine("Agora escolha uma das opções abaixo para seu Tamagochi:");
            tamagochi.Personagem();

        }
    }
}
