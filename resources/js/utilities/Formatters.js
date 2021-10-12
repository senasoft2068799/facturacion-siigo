class Formatters {
    formatCurrency(number) {
        var formatted = 0;
        if (!isNaN(number)) {
            formatted = new Intl.NumberFormat("es-CO", {
                style: "currency",
                currency: "COP"
            }).format(number);
        }
        return formatted;
    }
}

export default Formatters;
