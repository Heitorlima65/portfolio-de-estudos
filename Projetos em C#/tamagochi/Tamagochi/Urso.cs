using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Tamagochi
{
    internal class Urso : Tamagochi
    {
        public Urso(int alimentacao, int hidratacao, int felicidade, int energia, int limpeza, int saude) : base(alimentacao, hidratacao, felicidade, energia, limpeza, saude)
        {
        }

        public override void FazerSom()
        {
            Console.Clear();
            Console.WriteLine($"{Nome} rugiu para você!");
            Thread.Sleep(3000);
            Console.Clear();
        }
        public override void OpcaoFazerSom()
        {
            Console.Clear();
            Console.WriteLine($"{Nome} está rugindo!");
            Thread.Sleep(3000);
            Console.Clear();
        }
    }
}
