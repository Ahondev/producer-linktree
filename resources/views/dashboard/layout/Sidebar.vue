<template>
    <div :class="cn('pb-12', $attrs.class ?? '')">
        <div class="sidebar-container space-y-4 py-4">
            <div class="px-3 py-2">
                <div class="space-y-1">

                  <Button variant="secondary" class="w-full justify-start" @click="redirect('/dashboard/campaigns')">
                      <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          class="mr-2 h-4 w-4"
                      >
                          <path d="M9 21H15M9 21V16M9 21H3.6C3.26863 21 3 20.7314 3 20.4V16.6C3 16.2686 3.26863 16 3.6 16H9M15 21V9M15 21H20.4C20.7314 21 21 20.7314 21 20.4V3.6C21 3.26863 20.7314 3 20.4 3H15.6C15.2686 3 15 3.26863 15 3.6V9M15 9H9.6C9.26863 9 9 9.26863 9 9.6V16" stroke="currentColor" stroke-width="1.5"></path>
                      </svg>
                    Campagnes
                  </Button>
                    <Button variant="secondary" class="w-full justify-start" @click="redirect('/dashboard/analytics')">
                        <svg
                            width="24px"
                            height="24px"
                            stroke-width="1.5"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            color="currentColor"
                            class="mr-2 h-4 w-4"
                        >
                            <path d="M10 9H6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15.5 11C14.1193 11 13 9.88071 13 8.5C13 7.11929 14.1193 6 15.5 6C16.8807 6 18 7.11929 18 8.5C18 9.88071 16.8807 11 15.5 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M6 6H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M18 18L13.5 15L11 17L6 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M3 20.4V3.6C3 3.26863 3.26863 3 3.6 3H20.4C20.7314 3 21 3.26863 21 3.6V20.4C21 20.7314 20.7314 21 20.4 21H3.6C3.26863 21 3 20.7314 3 20.4Z" stroke="currentColor" stroke-width="1.5"></path>
                        </svg>
                        Statistiques
                    </Button>

<!--                  <Button variant="secondary" class="w-full justify-start" @click="redirect('/dashboard/appearance')">-->
<!--                      <svg-->
<!--                          xmlns="http://www.w3.org/2000/svg"-->
<!--                          viewBox="0 0 24 24"-->
<!--                          fill="none"-->
<!--                          stroke="currentColor"-->
<!--                          class="mr-2 h-4 w-4"-->
<!--                      >-->
<!--                          <path d="M2.63596 10.2927L9.70703 3.22168L18.1923 11.707L11.1212 18.778C10.3402 19.5591 9.07387 19.5591 8.29282 18.778L2.63596 13.1212C1.85492 12.3401 1.85492 11.0738 2.63596 10.2927Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M8.29297 1.80762L9.70718 3.22183" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M19.9991 15C19.9991 15 22.9991 17.9934 22.9994 19.8865C22.9997 21.5422 21.6552 22.8865 19.9997 22.8865C18.3442 22.8865 17.012 21.5422 17 19.8865C17.0098 17.9924 19.9991 15 19.9991 15Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="1.5" stroke-linecap="round" stroke-linejoin="round"></path>-->
<!--                      </svg>-->
<!--                    Apparence-->
<!--                  </Button>-->

                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { cn } from '@/lib/utils'
import { Button } from '@shadcn/components/ui/button'
import { ScrollArea } from '@shadcn/components/ui/scroll-area'
import {redirect} from "../../../js/http/request.js";

export default {
    methods: {redirect, cn },
    components: { Button, ScrollArea }
}
</script>

<style scoped>
.sidebar-container {
    position: sticky;
    top: 48px;
}
</style>
