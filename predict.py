#!/usr/bin/env python
# coding: utf-8

# In[29]:

import sys
import random
serv = sys.argv[1]
rens = sys.argv[2]

patient={'serv' : serv,
         'rens' : rens}


# In[30]:


cat1=['URGENCE','CHIRURGIE','URGENCE SAMU','URGENCE MEDICALE','COVID19']


# In[31]:



if patient['serv'] in cat1:
    nbrjour= random.randrange(0, 1)
    


# In[32]:


if cat1[1] in patient['serv']:
    nbrjour= random.randrange(3, 7)


# In[33]:


accgrav=['traumatisme','COVID19','tumeur','appendicte','polytraumatisme','suspision','crise','suspect','confusion mentale',
         'agression','accident','risque']
accgrav2=['trouble','controle','revision']


# In[34]:


if (patient['serv'] not in cat1):
    if(patient['rens'] in accgrav):
        nbrjour =  random.randrange(0, 1)
    elif (patient['rens'] in accgrav2) :
        nbrjour= random.randrange(7, 30)


# In[35]:


print(nbrjour)


# In[ ]:




