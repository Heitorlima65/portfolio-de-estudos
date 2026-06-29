using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace exercicioDia12do03
{
    internal class Program
    {
        static void Main(string[] args)
        {

            Cofre cofre = new Cofre();
            int escolha = 0;
            do
            {
                Console.WriteLine("1 - Abrir cofre:");
                Console.WriteLine("2 - fechar cofre");
                Console.WriteLine("3 - depositar:");
                Console.WriteLine("4 - sacar");
                Console.WriteLine("5 - verificar saldo:");
                Console.WriteLine("6 - sair");
                escolha = int.Parse(Console.ReadLine());
                if (escolha == 1)
                {
                    Console.WriteLine("digite a senha");
                    string senha = Console.ReadLine(); 
                    cofre.abrir(senha);
                }
                if (escolha == 2)
                {
                    Console.WriteLine("digite sua senha!");
                    string senha = Console.ReadLine();
                    cofre.fechar(senha);
                }
                if (escolha == 3)
                {
                    Console.WriteLine("digite sua senha para depositar");
                    string senha = Console.ReadLine();
                    cofre.depositar(senha);
                }
                if (escolha == 4)
                {
                    Console.WriteLine("digite sua senha");
                    string senha = Console.ReadLine();
                    cofre.sacar(senha);
                }
                if (escolha == 5)
                {
                    Console.WriteLine("digite sua senha");
                    string senha = Console.ReadLine();
                    cofre.VerSaldo(senha);
                }
                Console.Clear();
            }
            while (escolha != 6);

        }
    }
}
