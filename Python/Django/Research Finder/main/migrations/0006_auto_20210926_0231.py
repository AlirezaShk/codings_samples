# Generated by Django 3.2.7 on 2021-09-26 02:31

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('main', '0005_researcher_hindex'),
    ]

    operations = [
        migrations.RenameField(
            model_name='researcher',
            old_name='tags',
            new_name='fields',
        ),
        migrations.RenameField(
            model_name='university',
            old_name='tags',
            new_name='ranking',
        ),
        migrations.RemoveField(
            model_name='article',
            name='tags',
        ),
    ]