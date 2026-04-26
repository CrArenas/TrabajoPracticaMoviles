import { View, Text, TextInput, Pressable } from 'react-native'
import React, { useState } from 'react'
import { post } from '../../services/post';


export default function Register() {

  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  function enviarDatos() {
    const data = {
      name: name,
      email: email,
      password: password
    }
    post(data)
  }

  return (
    <View>
        <Text>Panel de registro</Text>
        <TextInput placeholder='Ingrese el nombre' 
          value = {name}
          onChangeText={setName}/>
        <TextInput placeholder='Ingrese un correo electrónico' 
          value = {email}
          onChangeText={setEmail}/>
        <TextInput placeholder='Ingrese una contraseña válida' 
          value = {password}
          onChangeText={setPassword}/>
        <Pressable onPress={enviarDatos()}>
            <Text>Registrarse</Text>
        </Pressable>
    </View>
  )
}