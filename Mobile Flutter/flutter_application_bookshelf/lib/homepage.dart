import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:flutter_application_bookshelf/editdata.dart';
import 'package:flutter_application_bookshelf/tambahdata.dart';
import 'package:http/http.dart' as http;

class HomePage extends StatefulWidget {
  const HomePage({Key? key}) : super(key: key);

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  List _listdata = [];

  Future _getdata() async {
    try {
      final response = await http
          .get(Uri.parse('http://192.168.1.3/FlutterAPI/crudbuku/read.php'));
      if (response.statusCode == 200) {
        //print(response.body);
        final data = jsonDecode(response.body);
        setState(() {
          _listdata = data;
        });
      }
    } catch (e) {
      print(e);
    }
  }

  Future _deletedata(String id) async {
    try {
      final response = await http.post(
          Uri.parse('http://192.168.1.3/FlutterAPI/crudbuku/delete.php'),
          body: {
            "id": id,
          });
      if (response.statusCode == 200) {
        return true;
      }
      return false;
    } catch (e) {
      print(e);
    }
  }

  @override
  void initState() {
    _getdata();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    List selesaiDibacaList =
        _listdata.where((item) => item['status_dibaca'] == '1').toList();

    List belumSelesaiDibacaList =
        _listdata.where((item) => item['status_dibaca'] == '0').toList();

    return Scaffold(
      appBar: AppBar(
        title: const Text("Rak Buku"),
        backgroundColor: Colors.blue,
        actions: [
          IconButton(
            icon: Icon(Icons.refresh),
            onPressed: () {
              _getdata();
              setState(() {});
            },
          ),
        ],
      ),
      body: Column(
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: [
          const Padding(
            padding: EdgeInsets.all(8.0),
            child: Text(
              'Belum Selesai Dibaca',
              style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
            ),
          ),
          Expanded(
            child: ListView.builder(
              itemCount: belumSelesaiDibacaList.length,
              itemBuilder: (context, index) {
                return Card(
                  shape: const RoundedRectangleBorder(
                    side: BorderSide(
                      color: Colors.red,
                      width: 3.0,
                    ),
                  ),
                  child: InkWell(
                    onTap: () {
                      Navigator.push(
                          context,
                          MaterialPageRoute(
                            builder: ((context) => EditData(
                                  ListData: {
                                    "id": belumSelesaiDibacaList[index]['id'],
                                    "judul": belumSelesaiDibacaList[index]
                                        ['judul'],
                                    "penulis": belumSelesaiDibacaList[index]
                                        ['penulis'],
                                    "tahun_terbit":
                                        belumSelesaiDibacaList[index]
                                            ['tahun_terbit'],
                                    "status_dibaca":
                                        belumSelesaiDibacaList[index]
                                            ['status_dibaca'],
                                  },
                                )),
                          ));
                    },
                    child: ListTile(
                      title: Text(belumSelesaiDibacaList[index]['judul']),
                      subtitle: Text(
                        "${belumSelesaiDibacaList[index]['tahun_terbit']}\n"
                        "${belumSelesaiDibacaList[index]['penulis']}\nBelum selesai dibaca",
                      ),
                      trailing: IconButton(
                          onPressed: () {
                            showDialog(
                              barrierDismissible: false,
                              context: context,
                              builder: ((context) {
                                return AlertDialog(
                                  content: Text("Hapus data?"),
                                  actions: [
                                    ElevatedButton(
                                        onPressed: () {
                                          _deletedata(
                                                  belumSelesaiDibacaList[index]
                                                      ['id'])
                                              .then((value) {
                                            if (value) {
                                              final snackBar = SnackBar(
                                                content: const Text(
                                                    'Data berhasil dihapus'),
                                              );
                                              ScaffoldMessenger.of(context)
                                                  .showSnackBar(snackBar);
                                            } else {
                                              final snackBar = SnackBar(
                                                content: const Text(
                                                    'Data gagal dihapus'),
                                              );
                                              ScaffoldMessenger.of(context)
                                                  .showSnackBar(snackBar);
                                            }
                                          });
                                          Navigator.pushAndRemoveUntil(
                                              context,
                                              MaterialPageRoute(
                                                  builder: ((context) =>
                                                      HomePage())),
                                              (route) => false);
                                        },
                                        child: Text("Hapus")),
                                    ElevatedButton(
                                        onPressed: () {
                                          Navigator.of(context).pop();
                                        },
                                        child: Text("Batal")),
                                  ],
                                );
                              }),
                            );
                          },
                          icon: Icon(Icons.delete)),
                    ),
                  ),
                );
              },
            ),
          ),
          const Padding(
            padding: EdgeInsets.all(8.0),
            child: Text(
              'Selesai Dibaca',
              style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
            ),
          ),
          Expanded(
            child: ListView.builder(
              itemCount: selesaiDibacaList.length,
              itemBuilder: (context, index) {
                return Card(
                  shape: const RoundedRectangleBorder(
                    side: BorderSide(
                      color: Colors.green,
                      width: 3.0,
                    ),
                  ),
                  child: InkWell(
                    onTap: () {
                      Navigator.push(
                          context,
                          MaterialPageRoute(
                            builder: ((context) => EditData(
                                  ListData: {
                                    "id": selesaiDibacaList[index]['id'],
                                    "judul": selesaiDibacaList[index]['judul'],
                                    "penulis": selesaiDibacaList[index]
                                        ['penulis'],
                                    "tahun_terbit": selesaiDibacaList[index]
                                        ['tahun_terbit'],
                                    "status_dibaca": selesaiDibacaList[index]
                                        ['status_dibaca'],
                                  },
                                )),
                          ));
                    },
                    child: ListTile(
                      title: Text(selesaiDibacaList[index]['judul']),
                      subtitle: Text(
                        "${selesaiDibacaList[index]['tahun_terbit']}\n"
                        "${selesaiDibacaList[index]['penulis']}\nSelesai dibaca",
                      ),
                      trailing: IconButton(
                          onPressed: () {
                            showDialog(
                              barrierDismissible: false,
                              context: context,
                              builder: ((context) {
                                return AlertDialog(
                                  content: Text("Hapus data?"),
                                  actions: [
                                    ElevatedButton(
                                        onPressed: () {
                                          _deletedata(selesaiDibacaList[index]
                                                  ['id'])
                                              .then((value) {
                                            if (value) {
                                              final snackBar = SnackBar(
                                                content: const Text(
                                                    'Data berhasil dihapus'),
                                              );
                                              ScaffoldMessenger.of(context)
                                                  .showSnackBar(snackBar);
                                            } else {
                                              final snackBar = SnackBar(
                                                content: const Text(
                                                    'Data gagal dihapus'),
                                              );
                                              ScaffoldMessenger.of(context)
                                                  .showSnackBar(snackBar);
                                            }
                                          });
                                          Navigator.pushAndRemoveUntil(
                                              context,
                                              MaterialPageRoute(
                                                  builder: ((context) =>
                                                      HomePage())),
                                              (route) => false);
                                        },
                                        child: Text("Hapus")),
                                    ElevatedButton(
                                        onPressed: () {
                                          Navigator.of(context).pop();
                                        },
                                        child: Text("Batal")),
                                  ],
                                );
                              }),
                            );
                          },
                          icon: Icon(Icons.delete)),
                    ),
                  ),
                );
              },
            ),
          ),
        ],
      ),
      floatingActionButton: FloatingActionButton(
          foregroundColor: Colors.black,
          backgroundColor: Colors.lightBlueAccent,
          child: const Icon(
            Icons.add,
          ),
          onPressed: () {
            Navigator.push(context,
                MaterialPageRoute(builder: ((context) => const TambahData())));
          }),
    );
  }
}
