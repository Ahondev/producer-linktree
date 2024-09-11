<template>
    <div class="w-100-vp h-100-vp flex justify-center align-center">
        <Card class="w-[350px]">
            <form action="">
                <CardHeader>
                    <CardTitle>Administrator panel</CardTitle>
                    <CardDescription>Login to access administrator panel</CardDescription>
                </CardHeader>
                <CardContent>
                    <input type="hidden" :value="csrf" />
                    <div class="mb-4 space-y-1.5">
                        <Label for="email" />
                        <Input id="email" placeholder="Email" v-model="email" />
                        <Label for="password" />
                        <Input id="password" placeholder="Password" type="password" v-model="password" />
                    </div>
                </CardContent>
                <CardFooter>
                    <div class="flex justify-end">
                        <Button @click.prevent="send()">Login</Button>
                    </div>
                </CardFooter>
            </form>
        </Card>
    </div>
</template>

<script>
import { Card, CardContent, CardDescription, CardHeader, CardTitle, CardFooter } from '@shadcn/components/ui/card'
import { Input } from '@shadcn/components/ui/input'
import { Label } from '@shadcn/components/ui/label'
import { Button } from '@shadcn/components/ui/button'
import { useToast } from '@shadcn/components/ui/toast/use-toast'
import { request, csrf, redirect } from "@/lib/utils";

export default {
    name: "Login",
    components: { Button, Label, Card, CardContent, CardHeader, CardDescription, CardTitle, CardFooter, Input },
    data() { return {
        csrf: csrf(),
        email: "",
        password: ""
    } },
    methods: {
        async send() {

            const { toast } = useToast()

            let response = await request(axios.post, "/login", {
                csrf: this.csrf,
                email: this.email,
                password: this.password
            })

            if (response.status !== 200) {
                toast({
                    title: 'Error',
                    description: 'Invalid credentials',
                })
            }

            if (response.status === 200) { redirect("/dashboard") }
        }
    }
}
</script>
