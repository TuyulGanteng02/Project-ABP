import 'package:flutter/material.dart';
import 'package:flutter_application_bookshelf/homepage.dart';
import 'package:http/http.dart' as http;

class TambahData extends StatefulWidget {
  const TambahData({super.key});

  @override
  State<TambahData> createState() => _TambahDataState();
}

class _TambahDataState extends State<TambahData> {
  bool _selesaiDibaca = false;
  final formkey = GlobalKey<FormState>();
  TextEditingController judul = TextEditingController();
  TextEditingController penulis = TextEditingController();
  TextEditingController tahunterbit = TextEditingController();
  TextEditingController status = TextEditingController();
  Future _simpan() async {
    final response = await http.post(
        Uri.parse("http://192.168.1.3/FlutterAPI/crudbuku/create.php"),
        body: {
          "judul": judul.text,
          "penulis": penulis.text,
          "tahun_terbit": tahunterbit.text,
          "status_dibaca": _selesaiDibaca ? '1' : '0',
        });
    if (response.statusCode == 200) {
      return true;
    }
    return false;
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Tambah Data"),
        backgroundColor: Colors.blue,
      ),
      body: Form(
          key: formkey,
          child: Container(
            padding: EdgeInsets.all(10),
            child: Column(
              children: [
                SizedBox(
                  height: 10,
                ),
                TextFormField(
                  controller: judul,
                  decoration: InputDecoration(
                    hintText: "Judul Buku",
                    border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(15)),
                  ),
                  validator: (value) {
                    if (value!.isEmpty) {
                      return "Judul harus diisi";
                    }
                    return null;
                  },
                ),
                SizedBox(
                  height: 10,
                ),
                TextFormField(
                  controller: penulis,
                  decoration: InputDecoration(
                    hintText: "Penulis",
                    border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(15)),
                  ),
                  validator: (value) {
                    if (value!.isEmpty) {
                      return "Penulis harus diisi";
                    }
                    return null;
                  },
                ),
                SizedBox(
                  height: 10,
                ),
                TextFormField(
                  controller: tahunterbit,
                  decoration: InputDecoration(
                    hintText: "Tahun Terbit",
                    border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(15)),
                  ),
                  validator: (value) {
                    if (value!.isEmpty) {
                      return "Tahun terbit harus diisi";
                    }
                    return null;
                  },
                ),
                Checkbox(
                  value: _selesaiDibaca,
                  onChanged: (bool? value) {
                    setState(() {
                      _selesaiDibaca = value!;
                    });
                  },
                ),
                const Text("Selesai dibaca"),
                SizedBox(
                  height: 10,
                ),
                ElevatedButton(
                  style: ElevatedButton.styleFrom(
                      shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(20),
                  )),
                  onPressed: () {
                    if (formkey.currentState!.validate()) {
                      _simpan().then((value) {
                        if (value) {
                          final snackBar = SnackBar(
                            content: const Text('Data berhasil ditambah'),
                          );
                          ScaffoldMessenger.of(context).showSnackBar(snackBar);
                        } else {
                          final snackBar = SnackBar(
                            content: const Text('Data gagal ditambah'),
                          );
                          ScaffoldMessenger.of(context).showSnackBar(snackBar);
                        }
                      });
                      Navigator.pushAndRemoveUntil(
                          context,
                          MaterialPageRoute(builder: ((context) => HomePage())),
                          (route) => false);
                    }
                  },
                  child: Text("Tambah"),
                )
              ],
            ),
          )),
    );
  }
}
