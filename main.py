def get_price(kode_spageti, topping):
    prices = {
        "S": {"A": 2100, "C": 2650, "D": 3100},
        "X": {"A": 2400, "C": 3150, "D": 3600},
    }
    return prices.get(kode_spageti, {}).get(topping, 0)

def main():
    isi = 'Y'
    while(isi == 'Y' or isi == 'y'):
        print("=== Program Perhitungan Pembelian Spageti ===")
        nama_pembeli = input("Masukkan Nama Pembeli: ")
        kode_spageti = input("Masukkan Kode Spageti (S: Besar, X: Kecil): ").upper()
        topping = input("Masukkan Topping (A: Vegetarian, C: Bolognaise, D: Carbonara): ")
        jumlah_beli = int(input("Masukkan Jumlah Beli: "))

        harga = get_price(kode_spageti, topping)
        if harga == 0:
            print("Kode atau topping tidak valid!")
            continue

        total_pembelian = harga * jumlah_beli
        pajak = total_pembelian * 0.05
        grand_total = total_pembelian + pajak

        print("\n=== Struk Pembelian ===")
        print(f"Nama Pembeli   : {nama_pembeli}")
        print(f"Kode Spageti   : {kode_spageti}")
        print(f"Topping        : {topping}")
        print(f"Harga Satuan   : Rp {harga}")
        print(f"Jumlah Beli    : {jumlah_beli}")
        print(f"Total Pembelian: Rp {total_pembelian}")
        print(f"Pajak (5%)     : Rp {pajak}")
        print(f"Grand Total    : Rp {grand_total}\n")

        isi = input("Masih Mengisi [Y/T]:")

if __name__ == "__main__":
    main()