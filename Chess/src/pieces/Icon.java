package pieces;

public enum Icon
{
        P(0), R(8), B(10), N(12), Q(14), K(15);

        private final int value;

        private Icon(int value)
        {
                this.value = value;
        }

        public int getValue()
        {
                return this.value;
        }
}
