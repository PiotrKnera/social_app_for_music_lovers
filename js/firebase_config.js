var firebaseConfig = {
  apiKey: "AIzaSyBCi1rIpeyln9k3t_UnuF9c1w6G29DauGY",
  authDomain: "spolecznosciowaaplikacjawebowa.firebaseapp.com",
  projectId: "spolecznosciowaaplikacjawebowa",
  storageBucket: "spolecznosciowaaplikacjawebowa.appspot.com",
  messagingSenderId: "269978047191",
  appId: "1:269978047191:web:118e15e6c92737ff399692"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const db = firebase.firestore();

db.settings({timestampsInSnapshots: true});
