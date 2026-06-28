using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Threading;
using System.Timers;

namespace Tamagochi
{
    internal class Program
    {
        

        static void Main(string[] args)
        {
            Tamagochi pet;

            Console.WriteLine("Bem vindo(a) ao Tamagochi!\n");
            Thread.Sleep(2000);
            Console.Clear();
            Thread.Sleep(1000);
            Console.WriteLine("Vamos criar um Tamagochi para você...\n");
            Thread.Sleep(2000);
            Console.Clear();
            Thread.Sleep(1000);

            while (true)
            {
                Console.WriteLine($"Escolha uma das opções abaixo para seu animalzinho:\n");

                Console.WriteLine("1 — Urso");
                Console.WriteLine("  __   __\r\n /  \\_/" +
                                  "  \\\n(   o.o   )\r\n )" +
                                  "   -   (\n");

                Console.WriteLine("2 - Gato");
                Console.WriteLine("\r\n /\\_/\\ " +
                                  "\r\n( o.o )" +
                                  "\r\n > ^ <" +
                                  "\r\n");

                Console.WriteLine("3 - Pinguim");
                Console.WriteLine("\r  ___  " +
                                  "\r\n (o o) " +
                                  "\r\n / V \\ " +
                                  "\r\n/(   )\\" +
                                  "\r\n  ^ ^  " +
                                  "\r\n");

                // Função usada para clicar em número na hora de escolher, em vez de digitar e depois clicar em Enter.
                //                  |
                //                  V
                ConsoleKeyInfo teclaEscolha = Console.ReadKey(true);

                switch (teclaEscolha.Key)
                {
                    case ConsoleKey.D1:
                        {
                            pet = new Urso(50, 50, 50, 50, 50, 50);

                            Thread.Sleep(2000);
                            Console.Clear();
                            pet.AnimalEscolha = "  __   __\r\n /  \\_/" +
                                          "  \\\n(   o.o   )\r\n )" +
                                          "   -   (\n";
                            Console.WriteLine("Você escolheu o urso!");
                            Console.WriteLine(pet.AnimalEscolha);
                            Thread.Sleep(2000);
                            Console.Clear();
                            Console.WriteLine(pet.AnimalEscolha);
                            break;
                        }

                    case ConsoleKey.D2:
                        {
                            pet = new Gato(50, 50, 50, 50, 50, 50);

                            Thread.Sleep(2000);
                            Console.Clear();
                            pet.AnimalEscolha = "\r\n /\\_/\\ " +
                                              "\r\n( o.o )" +
                                              "\r\n > ^ <" +
                                              "\r\n";
                            Console.WriteLine("Você escolheu o gato!");
                            Console.WriteLine(pet.AnimalEscolha);
                            Thread.Sleep(2000);
                            Console.Clear();
                            Console.WriteLine(pet.AnimalEscolha);
                            break;
                        }

                    case ConsoleKey.D3:
                        {
                            pet = new Pinguim(50, 50, 50, 50, 50, 50);

                            Thread.Sleep(2000);
                            Console.Clear();
                            pet.AnimalEscolha = "\r  ___  " +
                                          "\r\n (o o) " +
                                          "\r\n / V \\ " +
                                          "\r\n/(   )\\" +
                                          "\r\n  ^ ^  " +
                                          "\r\n";
                            Console.WriteLine("Você escolheu o pinguim!");
                            Console.WriteLine(pet.AnimalEscolha);
                            Thread.Sleep(2000);
                            Console.Clear();
                            Console.WriteLine(pet.AnimalEscolha);
                            break;
                        }

                    default:
                        {
                            Thread.Sleep(2000);
                            Console.Clear();
                            Console.WriteLine("Opção inválida. Tente novamente.");
                            Thread.Sleep(2000);
                            continue;
                        }
                }
                break;
            }
            Console.Write("Para começar, vamos definir um nome para ele, digite-o: ");
            pet.Nome = Console.ReadLine();

            ConsoleKeyInfo teclaConfirma;
            
            do
            {
                // Comando usado para verificar se o input do nome está vazio ou com espaços (semelhante ao if else,
                // porém ele não deixa passar enquanto estiver vazio)
                //                  |
                //                  V
                while (string.IsNullOrWhiteSpace(pet.Nome))
                {
                    Console.Clear();
                    Thread.Sleep(2000);
                    Console.Write("Nome vazio. Pressione Enter para tentar novamente.");
                    Console.ReadKey();
            
                    Console.Clear();
                    Thread.Sleep(2000);
                    Console.Write("Digite um nome para o seu Tamagochi: ");
                    pet.Nome = Console.ReadLine();
                }
            
                Console.Clear();
                Thread.Sleep(2000);
                Console.WriteLine($"Tem certeza de que deseja nomear seu Tamagochi de: {pet.Nome}? (S/N)");
            
                teclaConfirma = Console.ReadKey(true);
            
                while (teclaConfirma.Key != ConsoleKey.S && teclaConfirma.Key != ConsoleKey.N)
                {
                    Console.Clear();
                    Thread.Sleep(2000);
                    Console.WriteLine("Digite apenas S ou N.");
                    Console.ReadKey();
                    Console.Clear();
                    Thread.Sleep(2000);
                    Console.WriteLine($"Tem certeza de que deseja nomear seu Tamagochi de: {pet.Nome}? (S/N)");
            
                    teclaConfirma = Console.ReadKey(true);
                }
            
                if (teclaConfirma.Key == ConsoleKey.N)
                {
                    Console.Clear();
                    Console.Write("Digite um outro nome para o seu Tamagochi: ");
                    pet.Nome = Console.ReadLine();
                }
            
            } while (teclaConfirma.Key == ConsoleKey.N);
            
            Console.Clear();
            Console.WriteLine("Continue com a criação de " + pet.Nome);
            Thread.Sleep(2000);
            Console.Clear();


            Console.WriteLine($"Diga olá para {pet.Nome}!");
            Thread.Sleep(2000);
            Console.Clear();
            pet.FazerSom();
            Thread.Sleep(2000);
            Console.Clear();
            
            // Comando que cria o timer para diminuir os status do Tamagochi a cada 30 segundos
            //        |
            //        V
            System.Timers.Timer timer = new System.Timers.Timer(30000);
            
            //timer.Elapsed = quando o tempo acabar executa o metodo acabarTempo
            //   |
            //   V
            timer.Elapsed += pet.AcabarTempo;
            timer.Start();
            // ^
            // |
            // inicia/reinicia o contador
            
            while (true)
            {
                if ((pet.Alimentacao <= 0) && (pet.Hidratacao <= 0) && (pet.Saude <= 0))
                {
                    pet.Saude = 0;

                    DesenharTela(pet);
                    Console.WriteLine("Seu Tamagochi morreu!");
                    break;
                }
                //quando roda alguma ação, como o alimentar ele da um atualizar tela = true, 
                //e ai ativa o if que aciona o metodo desenhar tela e ai refaz a tela com os status atualizados 
                //assim como acontece com o acabarTempo mas esse funciona sozinho a cada 30s 
                //e rodando sozinho o AtualizarTela = true, ai ele atualiza a tela sozinho sem precisar apertar nada
                if (pet.AtualizarTela)
                {
                    DesenharTela(pet);
                    pet.AtualizarTela = false;
                }

                ConsoleKeyInfo teclaFuncoes;

                if (Console.KeyAvailable)
                {
                    teclaFuncoes = Console.ReadKey(true);
            
                    switch (teclaFuncoes.Key)
                    {
                        case ConsoleKey.D1:
                            {
                                pet.Alimentar();
                                pet.AtualizarTela = true;
                                break;
                            }
            
                        case ConsoleKey.D2:
                            {
                                pet.BeberAgua();
                                pet.AtualizarTela = true;
                                break;
                            }
            
                        case ConsoleKey.D3:
                            {
                                pet.Brincar();
                                pet.AtualizarTela = true;
                                break;
                            }
            
                        case ConsoleKey.D4:
                            {
                                pet.Dormir();
                                pet.AtualizarTela = true;
                                break;
                            }
            
                        case ConsoleKey.D5:
                            {
                                pet.OpcaoFazerSom();
                                pet.AtualizarTela = true;
                                break;
                            }
            
                        case ConsoleKey.D6:
                            {
                                pet.TomarBanho();
                                pet.AtualizarTela = true;
                                break;
                            }
            
                        case ConsoleKey.D7:
                            {
                                pet.TomarRemedio();
                                pet.AtualizarTela = true;
                                break;
                            }
            
                        case ConsoleKey.D8:
                            {
                                Console.WriteLine($"Obrigado por cuidar de {pet.Nome}! Até a próxima!");
                                return;
                            }
            
                        default:
                            {
                                Console.WriteLine("Opção inválida. Por favor, escolha uma opção válida.");
                                Thread.Sleep(1000);
                                pet.AtualizarTela = true;
                                break;
                            }
            
                    }
                }
            }
            Thread.Sleep(50);
        }

        static void DesenharTela(Tamagochi pet)
        {
            Console.Clear();
            pet.MostrarStatus(pet.Alimentacao, pet.Hidratacao, pet.Felicidade, pet.Energia, pet.Limpeza, pet.Saude);
            Console.WriteLine("\nO que você deseja fazer?:\n");
            Console.WriteLine("1 - Alimentar");
            Console.WriteLine("2 - Beber água");
            Console.WriteLine("3 - Brincar");
            Console.WriteLine("4 - Dormir");
            Console.WriteLine("5 - Fazer Som");
            Console.WriteLine("6 - Tomar Banho");
            Console.WriteLine("7 - Tomar Remédio");
            Console.WriteLine("8 - Sair");
        }
    }
}
