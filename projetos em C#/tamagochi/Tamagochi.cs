using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace tamagochi_novo_
{
    internal class Tamagochi
    {
        private string nome;
        public string personagem;

        public string Nome
        {
            get { return nome; }
            set { nome = value; }
        }

        public void Personagem()
        {
            Console.WriteLine("1 — Dragão");
            Console.WriteLine("\r\n  /\\_/\\" +
                              "  \r\n ( o o ) " +
                              "\r\n /  ^  \\ " +
                              "\r\n/|     |\\" +
                              "\r\n ||||| ||" +
                              "\r\n");

            Console.WriteLine("2 - Gato");
            Console.WriteLine("\r\n /\\_/\\ " +
                              "\r\n( o.o )" +
                              "\r\n > ^ <" +
                              "\r\n");

            Console.WriteLine("3 - Pinguim");
            Console.WriteLine("\r\n  ___  " +
                              "\r\n (o o) " +
                              "\r\n / V \\ " +
                              "\r\n/(   )\\" +
                              "\r\n  ^^  " +
                              "\r\n");

            Console.Write($"Escolha um dos três animais para o seu tamagochi: ");
            personagem = Console.ReadLine();

            if (personagem == "1")
            {
                Console.Clear();
                Console.WriteLine("Você escolheu o dragão!");
                Console.WriteLine("\r\n  /\\_/\\" +
                                  "  \r\n ( o o ) " +
                                  "\r\n /  ^  \\ " +
                                  "\r\n/|     |\\" +
                                  "\r\n ||||| ||" +
                                  "\r\n");

            }

            else if (personagem == "2")
            {
                Console.Clear();
                Console.WriteLine("Você escolheu o gato!");
                Console.WriteLine("\r\n /\\_/\\ " +
                                  "\r\n( o.o )" +
                                  "\r\n > ^ <" +
                                  "\r\n");
            }

            else if (personagem == "3")
            {
                Console.Clear();
                Console.WriteLine("Você escolheu o pinguim!");
                Console.WriteLine("\r\n  ___  " +
                                  "\r\n (o o) " +
                                  "\r\n / V \\ " +
                                  "\r\n/(   )\\" +
                                  "\r\n  ^^  " +
                                  "\r\n");
            }

            else
            {
                Console.Clear();
                Console.WriteLine("Opção inválida, escolha um número de 1-3");
            }
        }
    }
}
